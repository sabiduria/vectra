<?php
require_once '../config.php';

/**
 * Get sales data for a product
 */
function getSalesData($product_id, $days = 90) {
    global $pdo;
    
    $query = "
        SELECT 
            DATE(s.created) AS date, 
            SUM(si.qty) AS total_qty,
            SUM(si.subtotal) AS total_revenue
        FROM salesitems si
        JOIN sales s ON si.sale_id = s.id
        WHERE si.product_id = :product_id 
          AND s.created >= DATE_SUB(NOW(), INTERVAL :days DAY)
          AND s.deleted = 0
        GROUP BY DATE(s.created)
        ORDER BY date ASC
    ";
    
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':product_id', $product_id);
    $stmt->bindParam(':days', $days, PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Get current stock level for a product
 */
function getCurrentStock($product_id, $shop_id = null) {
    global $pdo;
    
    $query = "
        SELECT SUM(ss.stock) AS current_stock
        FROM shopstocks ss
        WHERE ss.product_id = :product_id
          AND ss.deleted = 0
    ";
    
    if ($shop_id) {
        $query .= " AND ss.shop_id = :shop_id";
    }
    
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':product_id', $product_id);
    if ($shop_id) {
        $stmt->bindParam(':shop_id', $shop_id);
    }
    $stmt->execute();
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? (float)$result['current_stock'] : 0;
}

/**
 * Calculate key inventory metrics
 */
function calculateInventoryMetrics($product_id, $lead_time_days = 7, $confidence_level = 1.65) {
    $sales_data = getSalesData($product_id);
    $current_stock = getCurrentStock($product_id);
    
    if (empty($sales_data)) {
        return null;
    }
    
    // Calculate basic metrics
    $total_sales = array_sum(array_column($sales_data, 'total_qty'));
    $days_count = count($sales_data);
    $avg_daily_sales = $total_sales / $days_count;
    
    // Calculate standard deviation for safety stock
    $sales_values = array_column($sales_data, 'total_qty');
    $variance = array_sum(array_map(function($x) use ($avg_daily_sales) {
        return pow($x - $avg_daily_sales, 2);
    }, $sales_values)) / $days_count;
    $std_dev = sqrt($variance);
    
    // Lead time demand
    $lead_time_demand = $avg_daily_sales * $lead_time_days;
    
    // Safety stock (using service level factor)
    $safety_stock = $confidence_level * $std_dev * sqrt($lead_time_days);
    
    // Reorder point
    $reorder_point = $lead_time_demand + $safety_stock;
    
    // Stock coverage days
    $coverage_days = $current_stock / $avg_daily_sales;
    
    // Forecast next 30 days sales
    $forecast_days = 30;
    $forecast_sales = $avg_daily_sales * $forecast_days;
    
    return [
        'current_stock' => round($current_stock, 2),
        'avg_daily_sales' => round($avg_daily_sales, 2),
        'max_daily_sales' => round(max($sales_values), 2),
        'min_daily_sales' => round(min($sales_values), 2),
        'std_dev' => round($std_dev, 2),
        'lead_time_days' => $lead_time_days,
        'lead_time_demand' => round($lead_time_demand, 2),
        'safety_stock' => round($safety_stock, 2),
        'reorder_point' => round($reorder_point, 2),
        'coverage_days' => round($coverage_days, 2),
        'forecast_30days' => round($forecast_sales, 2),
        'sales_data' => $sales_data
    ];
}

/**
 * Get product details
 */
function getProductDetails($product_id) {
    global $pdo;
    
    $query = "
        SELECT p.id, p.name, p.reference, p.barcode, c.name AS category, 
               s.name AS supplier, pp.unit_price, pp.wholesale_price
        FROM products p
        LEFT JOIN categories c ON p.category_id = c.id
        LEFT JOIN suppliers s ON p.supplier_id = s.id
        LEFT JOIN pricings pp ON p.id = pp.product_id
        WHERE p.id = :product_id
          AND p.deleted = 0
        LIMIT 1
    ";
    
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':product_id', $product_id);
    $stmt->execute();
    
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

/**
 * Get all products for dropdown
 */
function getAllProducts() {
    global $pdo;
    
    $query = "
        SELECT p.id, p.name, p.reference, c.name AS category
        FROM products p
        LEFT JOIN categories c ON p.category_id = c.id
        WHERE p.deleted = 0
        ORDER BY p.name ASC
    ";
    
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>