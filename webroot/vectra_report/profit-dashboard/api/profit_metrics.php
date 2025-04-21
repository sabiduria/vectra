<?php
require 'config.php';

$startDate = isset($_GET['startDate']) ? sanitizeInput($_GET['startDate']) : date('Y-m-01');
$endDate = isset($_GET['endDate']) ? sanitizeInput($_GET['endDate']) : date('Y-m-t');

// Gross Profit Margin
$query = "
    SELECT 
        DATE_FORMAT(s.created, '%Y-%m') AS month,
        SUM(s.total_amount) AS revenue,
        SUM(pi.unit_price * si.qty) AS cogs
    FROM sales s
    JOIN salesitems si ON s.id = si.sale_id
    JOIN pricings pi ON si.product_id = pi.product_id
    WHERE s.created BETWEEN '$startDate' AND '$endDate'
    GROUP BY month
    ORDER BY month
";

$result = $conn->query($query);
$data = [];

while ($row = $result->fetch_assoc()) {
    $grossProfit = ($row['revenue'] - $row['cogs']) / $row['revenue'] * 100;
    $data[] = [
        'month' => $row['month'],
        'gross_profit' => round($grossProfit, 2),
        'revenue' => round($row['revenue'], 2),
        'cogs' => round($row['cogs'], 2)
    ];
}

// Net Profit (Revenue - COGS - Expenses)
$expenseQuery = "
    SELECT 
        DATE_FORMAT(created, '%Y-%m') AS month,
        SUM(amount) AS total_expenses
    FROM expenses
    WHERE created BETWEEN '$startDate' AND '$endDate'
    GROUP BY month
    ORDER BY month
";

$expenseResult = $conn->query($expenseQuery);
$expenses = [];

while ($row = $expenseResult->fetch_assoc()) {
    $expenses[$row['month']] = $row['total_expenses'];
}

// Combine data
foreach ($data as &$monthData) {
    $month = $monthData['month'];
    $netProfit = ($monthData['revenue'] - $monthData['cogs'] - ($expenses[$month] ?? 0)) / $monthData['revenue'] * 100;
    $monthData['net_profit'] = round($netProfit, 2);
    $monthData['expenses'] = $expenses[$month] ?? 0;
}

echo json_encode($data);
$conn->close();
?>