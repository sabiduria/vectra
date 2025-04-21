<?php
require '../config.php';
header('Content-Type: application/json');

// Input Validation
$shop_id = isset($_GET['shop_id']) ? (int)$_GET['shop_id'] : null;
$timeframe = isset($_GET['timeframe']) && in_array($_GET['timeframe'], ['7d','30d','90d']) 
              ? $_GET['timeframe'] : '30d';

try {
    // 1. Stock Turnover Ratio (STR)
    $strQuery = $pdo->prepare("
        SELECT 
            p.id,
            p.name,
            COALESCE(SUM(si.qty), 0) AS sold_quantity,
            COALESCE(AVG(ss.stock), 0) AS avg_stock,
            CASE 
                WHEN COALESCE(AVG(ss.stock), 0) > 0 
                THEN COALESCE(SUM(si.qty), 0) / COALESCE(AVG(ss.stock), 0)
                ELSE 0 
            END AS turnover_ratio
        FROM products p
        LEFT JOIN salesitems si ON p.id = si.product_id
        LEFT JOIN sales s ON si.sale_id = s.id
        LEFT JOIN shopstocks ss ON p.id = ss.product_id
        INNER JOIN rooms R ON R.id = ss.room_id
        WHERE 
            s.created >= DATE_SUB(NOW(), INTERVAL :days DAY)
            AND (:shop_id IS NULL OR R.shops_id = :shop_id)
            AND p.deleted = 0
        GROUP BY p.id
        HAVING avg_stock > 0
        ORDER BY turnover_ratio DESC
    ");
    
    $daysMap = ['7d' => 7, '30d' => 30, '90d' => 90];
    $strQuery->execute([':days' => $daysMap[$timeframe], ':shop_id' => $shop_id]);
    $turnoverData = $strQuery->fetchAll(PDO::FETCH_ASSOC);

    // 2. Dead Stock Identification
    $deadStockQuery = $pdo->prepare("
        SELECT 
            p.id,
            p.name,
            ss.stock,
            DATEDIFF(NOW(), MAX(s.created)) AS days_since_last_sale
        FROM products p
        JOIN shopstocks ss ON p.id = ss.product_id
        LEFT JOIN salesitems si ON p.id = si.product_id
        LEFT JOIN sales s ON si.sale_id = s.id
        INNER JOIN rooms R ON R.id = ss.room_id
        WHERE 
            ss.stock > 0
            AND (:shop_id IS NULL OR R.shops_id = :shop_id)
            AND p.deleted = 0
        GROUP BY p.id, ss.stock
        HAVING days_since_last_sale > 90 OR days_since_last_sale IS NULL
    ");
    $deadStockQuery->execute([':shop_id' => $shop_id]);
    $deadStock = $deadStockQuery->fetchAll(PDO::FETCH_ASSOC);

    // 3. Stockout Events
    $stockouts = $pdo->prepare("
        SELECT 
            p.id,
            p.name,
            COUNT(o.id) AS stockout_events
        FROM ordersitems oi
        JOIN products p ON oi.product_id = p.id
        JOIN orders o ON oi.order_id = o.id
        LEFT JOIN shopstocks ss ON p.id = ss.product_id
        INNER JOIN rooms R ON R.id = ss.room_id
        WHERE 
            o.created >= DATE_SUB(NOW(), INTERVAL :days DAY)
            AND (:shop_id IS NULL OR R.shops_id = :shop_id)
            AND ss.stock <= 0
            AND o.status_id NOT IN (SELECT id FROM statuses WHERE name = 'Cancelled')
        GROUP BY p.id
    ");
    $stockouts->execute([':days' => $daysMap[$timeframe], ':shop_id' => $shop_id]);
    $stockoutData = $stockouts->fetchAll(PDO::FETCH_ASSOC);

    // Compile response
    $response = [
        'meta' => [
            'timeframe' => $timeframe,
            'shop_id' => $shop_id,
            'generated_at' => date('c')
        ],
        'data' => [
            'turnover_analysis' => $turnoverData,
            'dead_stock' => $deadStock,
            'stockout_events' => $stockoutData
        ]
    ];

    echo json_encode($response, JSON_PRETTY_PRINT);

} catch(PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database operation failed']);
    error_log("Stock Metrics Error: " . $e->getMessage());
}
?>