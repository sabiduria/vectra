<?php
// Database connection
$db = new PDO('mysql:host=localhost;dbname=vectra', 'root', '');

// Fetch sales data for a product (e.g., product_id = 123)
$product_id = 1;
$query = $db->prepare("
    SELECT 
        DATE(s.created) AS date,
        SUM(si.qty) AS daily_sales
    FROM salesitems si
    JOIN sales s ON si.sale_id = s.id
    WHERE si.product_id = :product_id
    AND s.created >= DATE_SUB(NOW(), INTERVAL 90 DAY)
    GROUP BY date
    ORDER BY date
");
$query->execute(['product_id' => $product_id]);
$salesData = $query->fetchAll(PDO::FETCH_ASSOC);

// Fetch current stock
$stockQuery = $db->prepare("
    SELECT stock FROM shopstocks 
    WHERE product_id = :product_id 
    LIMIT 1
");
$stockQuery->execute(['product_id' => $product_id]);
$currentStock = $stockQuery->fetchColumn();

// Calculate metrics
$totalSales = array_sum(array_column($salesData, 'daily_sales'));
$daysOfData = count($salesData);
$averageDailySales = $totalSales / max($daysOfData, 1); // Avoid division by zero

// Weighted Moving Average (WMA) for forecast
$weights = [];
$weightedSales = 0;
$totalWeight = 0;
foreach ($salesData as $i => $row) {
    $weight = ($i + 1) * 0.5; // Linear weights (adjust as needed)
    $weights[] = $weight;
    $weightedSales += $row['daily_sales'] * $weight;
    $totalWeight += $weight;
}
$forecastDailySales = $weightedSales / max($totalWeight, 1);

// Days of Inventory Remaining (DIR)
$dir = $currentStock / max($forecastDailySales, 0.1); // Prevent division by zero

// Output as JSON
header('Content-Type: application/json');
echo json_encode([
    'dates' => array_column($salesData, 'date'),
    'sales' => array_column($salesData, 'daily_sales'),
    'currentStock' => $currentStock,
    'forecastDailySales' => round($forecastDailySales, 2),
    'daysOfInventory' => round($dir, 2),
]);
?>