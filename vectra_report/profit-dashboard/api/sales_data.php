<?php
require 'config.php';

$period = isset($_GET['period']) ? sanitizeInput($_GET['period']) : 'last_6_months';

switch ($period) {
    case 'last_year':
        $dateCondition = "created >= DATE_SUB(NOW(), INTERVAL 1 YEAR)";
        $groupFormat = "%Y-%m";
        break;
    case 'last_6_months':
    default:
        $dateCondition = "created >= DATE_SUB(NOW(), INTERVAL 6 MONTH)";
        $groupFormat = "%Y-%m";
        break;
}

$query = "
    SELECT 
        DATE_FORMAT(created, '$groupFormat') AS period,
        SUM(total_amount) AS total_sales,
        COUNT(id) AS order_count
    FROM sales
    WHERE $dateCondition
    GROUP BY period
    ORDER BY period
";

$result = $conn->query($query);
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = [
        'period' => $row['period'],
        'total_sales' => (float)$row['total_sales'],
        'order_count' => (int)$row['order_count']
    ];
}

echo json_encode($data);
$conn->close();
?>