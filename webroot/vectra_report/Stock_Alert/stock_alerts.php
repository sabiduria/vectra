<?php
header('Content-Type: application/json');
require '../config.php'; // Your DB connection script

// Fetch low stock items with turnover/spoilage risk
$query = "
    SELECT 
        p.id, 
        p.name, 
        p.reference, 
        ss.stock, 
        ss.stock_min, 
        ss.stock_max,
        COALESCE(SUM(si.qty), 0) AS sold_last_30d,
        COALESCE(SUM(sp.qty), 0) AS spoiled_last_30d,
        ROUND(ss.stock / NULLIF(SUM(si.qty)/30, 0), 999) AS days_of_stock_left
    FROM 
        products p
    JOIN 
        shopstocks ss ON p.id = ss.product_id
    LEFT JOIN 
        salesitems si ON p.id = si.product_id AND si.created >= NOW() - INTERVAL 30 DAY
    LEFT JOIN 
        spoilages sp ON p.id = sp.product_id AND sp.created >= NOW() - INTERVAL 30 DAY
    GROUP BY 
        p.id
    HAVING 
        ss.stock < ss.stock_min * 1.5 OR days_of_stock_left < 10
";
$result = $pdo->query($query);
$data = $result->fetchAll(PDO::FETCH_ASSOC);

// Classify alert levels
foreach ($data as &$item) {
    $item['alert_level'] = (
        $item['stock'] < $item['stock_min'] ? 'critical' : 
        ($item['days_of_stock_left'] < 7 ? 'warning' : 'healthy')
    );
}

echo json_encode($data);
?>