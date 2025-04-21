<?php
header('Content-Type: application/json');
require_once '../config.php'; // Database connection

// Fetch Stock Levels vs. Thresholds
$query = "
    SELECT 
        p.name AS product,
        ss.stock,
        ss.stock_min,
        ss.stock_max,
        ROUND((ss.stock / ss.stock_max) * 100) AS fill_rate
    FROM shopstocks ss
    JOIN products p ON ss.product_id = p.id
    WHERE ss.deleted = 0
    ORDER BY fill_rate ASC
";
$result = $pdo->query($query);
$stockLevels = $result->fetchAll(PDO::FETCH_ASSOC);

// Fetch Inventory Turnover (Sales vs. Inventory)
$turnoverQuery = "
    SELECT 
        p.name AS product,
        SUM(si.qty) AS sold_qty,
        AVG(ss.stock) AS avg_stock,
        ROUND(SUM(si.qty) / AVG(ss.stock), 2) AS turnover_rate
    FROM salesitems si
    JOIN products p ON si.product_id = p.id
    JOIN shopstocks ss ON p.id = ss.product_id
    WHERE si.created >= DATE_SUB(NOW(), INTERVAL 3 MONTH)
    GROUP BY p.id
";
$turnoverData = $pdo->query($turnoverQuery)->fetchAll(PDO::FETCH_ASSOC);

// Output JSON
echo json_encode([
    'stockLevels' => $stockLevels,
    'turnoverData' => $turnoverData
]);
?>