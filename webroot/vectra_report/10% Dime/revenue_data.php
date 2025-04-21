<?php
header('Content-Type: application/json');
$db = new PDO('mysql:host=localhost;dbname=vectra', 'root', '');

// Fetch daily revenue (last 30 days)
$query = $db->prepare("
    SELECT 
        DATE(s.created) AS date,
        SUM(s.total_amount) AS revenue,
        SUM(s.total_amount) * 0.1 AS target_10perc
    FROM sales s
    WHERE s.created >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
    GROUP BY date
    ORDER BY date
");
$query->execute();
$dailyData = $query->fetchAll(PDO::FETCH_ASSOC);

// Fetch monthly revenue (last 12 months)
$query = $db->prepare("
    SELECT 
        DATE_FORMAT(s.created, '%Y-%m') AS month,
        SUM(s.total_amount) AS revenue,
        SUM(s.total_amount) * 0.1 AS target_10perc
    FROM sales s
    WHERE s.created >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH)
    GROUP BY month
    ORDER BY month
");
$query->execute();
$monthlyData = $query->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
    'daily' => $dailyData,
    'monthly' => $monthlyData
]);
?>