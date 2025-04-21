<?php
require 'config.php';

header('Content-Type: application/json');

try {
    // Calculate Gross Margin
    $salesQuery = $pdo->query("
        SELECT 
            SUM(si.subtotal) AS total_sales,
            SUM(si.qty * COALESCE(pi.avg_cost, 0)) AS cogs
        FROM salesitems si
        LEFT JOIN (
            SELECT 
                product_id,
                SUM(qty * price) / SUM(qty) AS avg_cost
            FROM purchasesitems
            GROUP BY product_id
        ) pi ON si.product_id = pi.product_id
    ");
    $salesData = $salesQuery->fetch();
    
    $grossMargin = $salesData['total_sales'] - $salesData['cogs'];

    // Calculate Average Inventory Cost
    $inventoryQuery = $pdo->query("
        SELECT 
            SUM(ss.stock * COALESCE(pi.avg_cost, 0)) AS inventory_cost
        FROM shopstocks ss
        LEFT JOIN (
            SELECT 
                product_id,
                SUM(qty * price) / SUM(qty) AS avg_cost
            FROM purchasesitems
            GROUP BY product_id
        ) pi ON ss.product_id = pi.product_id
    ");
    $inventoryCost = $inventoryQuery->fetchColumn();

    // Calculate GMROI
    $gmroi = ($inventoryCost > 0) ? ($grossMargin / $inventoryCost) * 100 : 0;

    // Monthly Trends
    $trendQuery = $pdo->query("
        SELECT 
            DATE_FORMAT(s.created, '%Y-%m') AS month,
            (SUM(si.subtotal) - SUM(si.qty * COALESCE(pi.avg_cost, 0))) / 
            NULLIF(SUM(ss.stock * COALESCE(pi.avg_cost, 0)), 0) * 100 AS gmroi
        FROM sales s
        JOIN salesitems si ON s.id = si.sale_id
        LEFT JOIN (
            SELECT product_id, SUM(qty * price)/SUM(qty) AS avg_cost
            FROM purchasesitems 
            GROUP BY product_id
        ) pi ON si.product_id = pi.product_id
        LEFT JOIN shopstocks ss ON si.product_id = ss.product_id
        GROUP BY month
        ORDER BY month
    ");
    $trendData = $trendQuery->fetchAll();

    echo json_encode([
        'current_gmroi' => round($gmroi, 2),
        'trends' => $trendData
    ]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>