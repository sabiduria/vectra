<?php
require '../config.php';

header('Content-Type: application/json');

try {
  $query = $pdo->query("
    WITH monthly_revenue AS (
  SELECT 
    DATE_FORMAT(created, '%Y-%m') AS month,
    SUM(total_amount) AS revenue
  FROM sales
  GROUP BY month
)
SELECT 
  month,
  revenue,
  IFNULL(
    ((revenue - LAG(revenue) OVER (ORDER BY month)) / NULLIF(LAG(revenue) OVER (ORDER BY month), 0)) * 100,
    0
  ) AS growth_rate
FROM monthly_revenue
ORDER BY month DESC
LIMIT 12;
  ");
  echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));
} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode(['error' => $e->getMessage()]);
}
?>