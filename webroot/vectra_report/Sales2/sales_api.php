<?php
header('Content-Type: application/json');
require '../config.php'; // Your DB connection script

// Fetch sales trend (last 12 months)
if ($_GET['action'] == 'sales_trend') {
    $query = $pdo->query("
        SELECT 
            DATE_FORMAT(s.created, '%Y-%m') AS month,
            SUM(s.total_amount) AS revenue,
            COUNT(DISTINCT s.customer_id) AS unique_customers
        FROM sales s
        WHERE s.created >= DATE_SUB(NOW(), INTERVAL 12 MONTH)
        GROUP BY month
        ORDER BY month
    ");
    echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));
}

// Fetch top products (current year)
elseif ($_GET['action'] == 'top_products') {
    $query = $pdo->query("
        SELECT 
            p.name AS product,
            SUM(si.subtotal) AS revenue,
            SUM(si.qty) AS units_sold
        FROM salesitems si
        JOIN products p ON si.product_id = p.id
        JOIN sales s ON si.sale_id = s.id
        WHERE YEAR(s.created) = YEAR(NOW())
        GROUP BY p.id
        ORDER BY revenue DESC
        LIMIT 10
    ");
    echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));
}

// Fetch sales by hour (for intraday trends)
elseif ($_GET['action'] == 'sales_by_hour') {
    $query = $pdo->query("
        SELECT 
            HOUR(s.created) AS hour,
            SUM(s.total_amount) AS revenue
        FROM sales s
        GROUP BY hour
        ORDER BY hour
    ");
    echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));
}
?>