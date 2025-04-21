<?php
// Database connection
$pdo = new PDO('mysql:host=localhost;dbname=vectra', 'root', '');

    $annual_demand = $pdo->prepare("
        UPDATE products p
        JOIN (
            SELECT product_id, SUM(qty) * 12 AS annual_demand 
            FROM salesitems 
            WHERE created >= DATE_SUB(NOW(), INTERVAL 1 MONTH)
            GROUP BY product_id
        ) s ON p.id = s.product_id
        SET p.annual_demand = s.annual_demand;
    ");
    $annual_demand->execute();

    $lead_time_days = $pdo->prepare("
        UPDATE products p
        JOIN (
            SELECT 
                pi.product_id, 
                AVG(DATEDIFF(p.receipt_date, p.created)) AS avg_lead_time
            FROM purchasesitems pi
            JOIN purchases p ON pi.purchase_id = p.id
            GROUP BY pi.product_id
        ) lt ON p.id = lt.product_id
        SET p.lead_time_days = lt.avg_lead_time;
    ");
    $lead_time_days->execute();

    $holding_cost = $pdo->prepare("
        UPDATE products p
        JOIN pricings pr ON p.id = pr.product_id
        SET p.holding_cost = pr.unit_price * 0.20;
    ");
    $holding_cost->execute();

    $ordering_cost = $pdo->prepare("
        UPDATE products SET ordering_cost = 50.00;
    ");
    $ordering_cost->execute();

    echo "<p>EOQ parameters updated!</p>";
?>