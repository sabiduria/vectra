<?php
require_once '../config2.php';

header('Content-Type: application/json');

// Enable CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");

// Get dashboard data
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = $_GET['action'] ?? '';
    
    switch ($action) {
        case 'inventory_metrics':
            echo json_encode(getInventoryMetrics());
            break;
        case 'supplier_performance':
            echo json_encode(getSupplierPerformance());
            break;
        case 'purchase_recommendations':
            echo json_encode(getPurchaseRecommendations());
            break;
        default:
            echo json_encode(['error' => 'Invalid action']);
    }
}

/**
 * Get critical inventory metrics
 */
function getInventoryMetrics() {
    global $mysqli;
    
    $query = "
        SELECT 
    p.id,
    p.name,
    p.reference,
    ss.stock,
    ss.stock_min,
    ss.stock_max,

    -- Average daily sales over last 3 months
    IFNULL(SUM(si.qty) / 90, 0) AS avg_daily_sales,

    -- Average lead time in days
    IFNULL((
        SELECT AVG(DATEDIFF(p2.receipt_date, p2.created)) 
        FROM purchases p2
        JOIN purchasesitems pi2 ON p2.id = pi2.purchase_id
        WHERE pi2.product_id = p.id
    ), 7) AS avg_lead_time,

    -- Reorder point = avg_daily_sales * avg_lead_time + 20% buffer of stock_max
    ROUND(
        (IFNULL(SUM(si.qty) / 90, 0) * 
         IFNULL((
            SELECT AVG(DATEDIFF(p2.receipt_date, p2.created)) 
            FROM purchases p2
            JOIN purchasesitems pi2 ON p2.id = pi2.purchase_id
            WHERE pi2.product_id = p.id
         ), 7)
        ) + (0.2 * ss.stock_max), 2
    ) AS reorder_point,

    -- Stock status
    CASE 
        WHEN ss.stock < (
            (IFNULL(SUM(si.qty) / 90, 0) * 
             IFNULL((
                SELECT AVG(DATEDIFF(p2.receipt_date, p2.created)) 
                FROM purchases p2
                JOIN purchasesitems pi2 ON p2.id = pi2.purchase_id
                WHERE pi2.product_id = p.id
             ), 7)
            ) + (0.2 * ss.stock_max)
        ) THEN 'CRITICAL'
        WHEN ss.stock < ss.stock_min THEN 'LOW'
        ELSE 'OK'
    END AS stock_status,

    -- Turnover rate: Total sold / average stock
    ROUND(IFNULL(SUM(si.qty), 0) / NULLIF(AVG(ss.stock), 0), 2) AS turnover_rate,

    -- Days of stock = Avg stock / Avg daily sales
    ROUND(IFNULL(AVG(ss.stock), 0) / NULLIF(IFNULL(SUM(si.qty) / 90, 0), 0), 2) AS days_of_stock

FROM products p
LEFT JOIN shopstocks ss ON p.id = ss.product_id
LEFT JOIN salesitems si ON p.id = si.product_id
LEFT JOIN sales s ON si.sale_id = s.id AND s.created >= DATE_SUB(NOW(), INTERVAL 3 MONTH)

GROUP BY p.id
ORDER BY 
    FIELD(stock_status, 'CRITICAL', 'LOW', 'OK'), 
    days_of_stock ASC;
    ";
    
    $result = $mysqli->query($query);
    return $result->fetch_all(MYSQLI_ASSOC);
}

/**
 * Get supplier performance metrics
 */
function getSupplierPerformance() {
    global $mysqli;
    
    $query = "
        SELECT 
    s.id,
    s.name,
    s.email,
    s.phone1,
    
    COUNT(p.id) AS total_orders,
    IFNULL(SUM(p.total_amount), 0) AS total_spend,
    
    IFNULL(AVG(DATEDIFF(p.receipt_date, p.due_date)), 0) AS avg_delay_days,
    
    IFNULL((COUNT(CASE WHEN p.receipt_date <= p.due_date THEN 1 END) / NULLIF(COUNT(p.id), 0)) * 100, 0) AS on_time_rate,
    
    IFNULL((SUM(sp.qty) / NULLIF(SUM(pi.qty), 0)) * 100, 0) AS defect_rate,
    
    IFNULL(AVG(pi.price), 0) AS avg_price,
    IFNULL(STDDEV(pi.price), 0) AS price_stddev,
    
    IFNULL(AVG(DATEDIFF(p.receipt_date, p.created)), 0) AS avg_lead_time,
    
    IFNULL((COUNT(CASE WHEN pt.amount IS NULL AND p.due_date < NOW() THEN 1 END) / NULLIF(COUNT(p.id), 0)) * 100, 0) AS late_payment_rate,

    (
        IFNULL((COUNT(CASE WHEN p.receipt_date <= p.due_date THEN 1 END) / NULLIF(COUNT(p.id), 0)) * 100, 0) * 0.4 +
        (100 - IFNULL((SUM(sp.qty) / NULLIF(SUM(pi.qty), 0)) * 100, 0)) * 0.3 +
        (100 - IFNULL((COUNT(CASE WHEN pt.amount IS NULL AND p.due_date < NOW() THEN 1 END) / NULLIF(COUNT(p.id), 0)) * 100, 0)) * 0.2 +
        IFNULL((1 / NULLIF(IFNULL(AVG(DATEDIFF(p.receipt_date, p.created)), 0), 0)) * 10, 0) * 0.1
    ) AS performance_score

FROM suppliers s
LEFT JOIN purchases p ON s.id = p.supplier_id
LEFT JOIN purchasesitems pi ON p.id = pi.purchase_id
LEFT JOIN paymentstosuppliers pt ON p.id = pt.purchase_id
LEFT JOIN spoilages sp ON pi.product_id = sp.product_id AND sp.created BETWEEN p.created AND p.receipt_date

GROUP BY s.id
ORDER BY performance_score DESC;

    ";
    
    $result = $mysqli->query($query);
    return $result->fetch_all(MYSQLI_ASSOC);
}

/**
 * Get automated purchase recommendations
 */
function getPurchaseRecommendations() {
    $inventory = getInventoryMetrics();
    $suppliers = getSupplierPerformance();
    
    $recommendations = [];
    $criticalProducts = array_filter($inventory, function($item) {
        return $item['stock_status'] === 'CRITICAL';
    });
    
    foreach ($criticalProducts as $product) {
        // Find suppliers who provide this product
        $query = "
            SELECT 
                s.id,
                s.name,
                AVG(pi.price) AS avg_price,
                AVG(DATEDIFF(p.receipt_date, p.created)) AS avg_lead_time,
                (COUNT(CASE WHEN p.receipt_date <= p.due_date THEN 1 END) / COUNT(p.id)) * 100 AS on_time_rate
            FROM purchases p
            JOIN purchasesitems pi ON p.id = pi.purchase_id
            JOIN suppliers s ON p.supplier_id = s.id
            WHERE pi.product_id = ?
            GROUP BY s.id
            ORDER BY on_time_rate DESC, avg_price ASC
        ";
        
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $product['id']);
        $stmt->execute();
        $productSuppliers = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        
        if (!empty($productSuppliers)) {
            $bestSupplier = $productSuppliers[0];
            $qtyNeeded = $product['stock_max'] - $product['stock'];
            
            $recommendations[] = [
                'product_id' => $product['id'],
                'product_name' => $product['name'],
                'product_reference' => $product['reference'],
                'current_stock' => $product['stock'],
                'stock_min' => $product['stock_min'],
                'stock_max' => $product['stock_max'],
                'qty_needed' => $qtyNeeded,
                'supplier_id' => $bestSupplier['id'],
                'supplier_name' => $bestSupplier['name'],
                'supplier_price' => $bestSupplier['avg_price'],
                'estimated_lead_time' => $bestSupplier['avg_lead_time'],
                'estimated_cost' => $qtyNeeded * $bestSupplier['avg_price'],
                'urgency' => $product['days_of_stock'] < $bestSupplier['avg_lead_time'] ? 'HIGH' : 'MEDIUM'
            ];
        }
    }
    
    return $recommendations;
}
?>