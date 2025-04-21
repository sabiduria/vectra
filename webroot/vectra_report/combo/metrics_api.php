<?php
header('Content-Type: application/json');
require_once 'db_connection.php'; // Your DB config file

// Fetch Sales, Profit, and Growth Data (Last 6 Months)
$query = "
    SELECT 
        DATE_FORMAT(s.created, '%Y-%m') AS month,
        SUM(s.total_amount) AS sales,
        SUM(s.total_amount - (si.qty * sid.purchase_price)) AS profit, -- Assuming cost_price exists in products
        COUNT(DISTINCT s.customer_id) AS new_customers
    FROM sales s
    JOIN salesitems si ON s.id = si.sale_id
    JOIN products p ON si.product_id = p.id
    JOIN stockinsdetails sid ON sid.product_id = p.id
    WHERE s.created >= DATE_SUB(NOW(), INTERVAL 6 MONTH)
    GROUP BY month
    ORDER BY month
";

$result = $conn->query($query);
$data = [];
while ($row = $result->fetchAll(PDO::FETCH_ASSOC)) {
    $data[] = $row;
}

// Calculate MoM Growth Rate
for ($i = 1; $i < count($data); $i++) {
    $data[$i]['growth_rate'] = round(
        (($data[$i]['sales'] - $data[$i-1]['sales']) / $data[$i-1]['sales']) * 100, 
        2
    );
}
$data[0]['growth_rate'] = 0; // First month has no prior data

echo json_encode($data);
?>