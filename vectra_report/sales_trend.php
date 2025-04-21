<?php
$pdo = new PDO("mysql:host=localhost;dbname=vectra", "root", "");
$query = $pdo->query("
  SELECT 
    DATE_FORMAT(s.created, '%Y-%m') AS month,
    SUM(s.total_amount) AS revenue,
    COUNT(s.id) AS transactions
  FROM sales s
  GROUP BY month
  ORDER BY month DESC LIMIT 12
");
echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));
?>