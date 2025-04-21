<?php
//header('Content-Type: application/json');
$pdo = new PDO('mysql:host=localhost;dbname=vectra', 'root', '');

// Get product inventory data
$stmt = $pdo->query("
    SELECT 
        p.id,
        p.name,
        p.annual_demand,
        p.ordering_cost,
        p.holding_cost,
        p.lead_time_days,
        ss.stock,
        ss.stock_min,
        ss.stock_max,
        SQRT((2 * annual_demand * ordering_cost) / holding_cost) AS eoq
    FROM products p
    JOIN shopstocks ss ON p.id = ss.product_id
");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

$results = [];
foreach ($products as $product) {
    // EOQ Calculation
    $eoq = sqrt((2 * $product['annual_demand'] * $product['ordering_cost']) / $product['holding_cost']);
    
    // Safety Stock (20% of lead time demand)
    $daily_demand = $product['annual_demand'] / 365;
    $safety_stock = $daily_demand * $product['lead_time_days'] * 0.2;
    
    // Reorder Point
    $reorder_point = ($daily_demand * $product['lead_time_days']) + $safety_stock;
    
    // Total Cost
    $total_cost = ($product['annual_demand'] / $eoq * $product['ordering_cost']) + 
                 ($eoq / 2 * $product['holding_cost']);

    $results[] = [
        'product' => $product['name'],
        'current_stock' => $product['stock'],
        'eoq' => round($eoq, 2),
        'reorder_point' => round($reorder_point, 2),
        'safety_stock' => round($safety_stock, 2),
        'total_cost' => round($total_cost, 2),
        'ordering_cost_curve' => generateCostCurve($product, 50)
    ];
}

function generateCostCurve($product, $points) {
    $curve = [];
    $max_q = $product['eoq'] * 3;
    $step = $max_q / $points;
    
    for ($q = 1; $q <= $max_q; $q += $step) {
        $ordering_cost = ($product['annual_demand'] / $q) * $product['ordering_cost'];
        $holding_cost = ($q / 2) * $product['holding_cost'];
        $curve[] = [
            'quantity' => round($q, 2),
            'total_cost' => round($ordering_cost + $holding_cost, 2),
            'ordering_cost' => round($ordering_cost, 2),
            'holding_cost' => round($holding_cost, 2)
        ];
    }
    return $curve;
}

echo json_encode($results);
?>