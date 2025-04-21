<?php
// sales_data.php
require_once '../config.php';

header('Content-Type: application/json');

$response = [
    'status' => 'error',
    'data' => null,
    'message' => ''
];

try {
    // Get parameters from request
    $timeframe = $_GET['timeframe'] ?? 'monthly';
    $shop_id = $_GET['shop_id'] ?? null;
    $start_date = $_GET['start_date'] ?? null;
    $end_date = $_GET['end_date'] ?? null;
    
    // Validate and sanitize inputs
    $shop_id = $shop_id ? intval($shop_id) : null;
    
    // Base query
    $sql = "SELECT 
                DATE_FORMAT(s.created, '%Y-%m-%d') AS day,
                DATE_FORMAT(s.created, '%Y-%m') AS month,
                DATE_FORMAT(s.created, '%Y') AS year,
                SUM(s.total_amount) AS total_sales,
                COUNT(s.id) AS transaction_count,
                AVG(s.total_amount) AS avg_transaction_value,
                sh.name AS shop_name,
                a.name AS area_name,
                GROUP_CONCAT(DISTINCT p.name ORDER BY p.name SEPARATOR ', ') AS top_products
            FROM sales s
            JOIN shops sh ON s.shop_id = sh.id
            JOIN areas a ON sh.area_id = a.id
            JOIN salesitems si ON s.id = si.sale_id
            JOIN products p ON si.product_id = p.id";
    
    // Where conditions
    $where = [];
    $params = [];
    
    if ($shop_id) {
        $where[] = "s.shop_id = ?";
        $params[] = $shop_id;
    }
    
    if ($start_date && $end_date) {
        $where[] = "s.created BETWEEN ? AND ?";
        $params[] = $start_date;
        $params[] = $end_date;
    } else {
        // Default to last 12 months if no date range provided
        $where[] = "s.created >= DATE_SUB(NOW(), INTERVAL 12 MONTH)";
    }
    
    if (!empty($where)) {
        $sql .= " WHERE " . implode(" AND ", $where);
    }
    
    // Group by based on timeframe
    switch ($timeframe) {
        case 'daily':
            $sql .= " GROUP BY day, sh.name, a.name";
            break;
        case 'weekly':
            $sql .= " GROUP BY YEARWEEK(s.created), sh.name, a.name";
            break;
        case 'monthly':
        default:
            $sql .= " GROUP BY month, sh.name, a.name";
            break;
        case 'yearly':
            $sql .= " GROUP BY year, sh.name, a.name";
            break;
    }
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    
    $salesData = [];
    $shopPerformance = [];
    $productPerformance = [];
    $timeSeries = [];
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $salesData[] = $row;
        
        // Aggregate for shop performance
        $shopKey = $row['shop_name'] . '|' . $row['area_name'];
        if (!isset($shopPerformance[$shopKey])) {
            $shopPerformance[$shopKey] = [
                'total_sales' => 0,
                'transaction_count' => 0,
                'shop_name' => $row['shop_name'],
                'area_name' => $row['area_name']
            ];
        }
        $shopPerformance[$shopKey]['total_sales'] += $row['total_sales'];
        $shopPerformance[$shopKey]['transaction_count'] += $row['transaction_count'];
        
        // Aggregate for time series
        $timeKey = $row[$timeframe === 'daily' ? 'day' : ($timeframe === 'weekly' ? 'yearweek' : ($timeframe === 'monthly' ? 'month' : 'year'))];
        if (!isset($timeSeries[$timeKey])) {
            $timeSeries[$timeKey] = [
                'total_sales' => 0,
                'transaction_count' => 0,
                'date_label' => $timeKey
            ];
        }
        $timeSeries[$timeKey]['total_sales'] += $row['total_sales'];
        $timeSeries[$timeKey]['transaction_count'] += $row['transaction_count'];
        
        // Process top products
        if (!empty($row['top_products'])) {
            $products = explode(', ', $row['top_products']);
            foreach ($products as $product) {
                if (!isset($productPerformance[$product])) {
                    $productPerformance[$product] = 0;
                }
                $productPerformance[$product] += $row['total_sales'];
            }
        }
    }
    
    // Sort product performance
    arsort($productPerformance);
    $topProducts = array_slice($productPerformance, 0, 10, true);
    
    // Prepare final response
    $response['status'] = 'success';
    $response['data'] = [
        'sales_data' => $salesData,
        'shop_performance' => array_values($shopPerformance),
        'time_series' => array_values($timeSeries),
        'product_performance' => $topProducts
    ];
    
} catch (Exception $e) {
    $response['message'] = 'Error: ' . $e->getMessage();
} finally {
    echo json_encode($response);
}
?>