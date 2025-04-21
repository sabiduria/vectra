<?php
header('Content-Type: application/json');
require '../config.php'; // Your DB connection file

// Fetch Monthly Revenue (Last 12 Months)
$query = "
    WITH monthly_revenue AS (
    SELECT 
        DATE_FORMAT(s.created, '%Y-%m') AS month,
        SUM(s.total_amount) AS revenue
    FROM sales s
    WHERE s.created >= DATE_SUB(NOW(), INTERVAL 24 MONTH)
    GROUP BY month
)
SELECT 
    month,
    revenue,
    IFNULL(LAG(revenue, 12) OVER (ORDER BY month), 0) AS revenue_prev_year,
    IFNULL(LAG(revenue, 1) OVER (ORDER BY month), 0) AS revenue_prev_month
FROM monthly_revenue
ORDER BY month DESC
LIMIT 12;

";
$result = $pdo->query($query);
$monthlyRevenue = $result->fetchAll(PDO::FETCH_ASSOC);

// Fetch Revenue by Shop
$query = "
    SELECT 
        sh.name AS shop,
        SUM(s.total_amount) AS revenue
    FROM sales s
    JOIN shops sh ON s.shop_id = sh.id
    WHERE s.created >= DATE_SUB(NOW(), INTERVAL 6 MONTH)
    GROUP BY sh.name
    ORDER BY revenue DESC
";
$result = $pdo->query($query);
$revenueByShop = $result->fetchAll(PDO::FETCH_ASSOC);

// Top Products
$query = "
    SELECT 
        p.name AS product,
        SUM(si.subtotal) AS revenue
    FROM salesitems si
    JOIN products p ON si.product_id = p.id
    GROUP BY p.name
    ORDER BY revenue DESC
    LIMIT 10
";
$result = $pdo->query($query);
$topProducts = $result->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
    'monthlyRevenue' => $monthlyRevenue,
    'revenueByShop' => $revenueByShop,
    'topProducts' => $topProducts
]);
?>