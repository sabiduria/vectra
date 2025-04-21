<?php
require '../config.php';

header('Content-Type: application/json');

try {
  $query = $pdo->query("
    SELECT 
      p.name,
      SUM(s.stock * pr.unit_price) AS total_value
    FROM shopstocks s
    JOIN products p ON s.product_id = p.id
    JOIN pricings pr ON p.id = pr.product_id
    GROUP BY p.id
    ORDER BY total_value DESC
    LIMIT 10
  ");
  echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));
} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode(['error' => $e->getMessage()]);
}
?>