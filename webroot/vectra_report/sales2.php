<?php
header('Content-Type: application/json');
require_once 'config.php';

$response = [];
$action = $_GET['action'] ?? '';

try {
    switch($action) {
        case 'revenue_trend':
            $period = $_GET['period'] ?? 'monthly';
            $shop_id = $_GET['shop_id'] ?? null;
            
            $sql = "SELECT ";
            
            switch($period) {
                case 'daily':
                    $sql .= "DATE(s.created) AS period, ";
                    break;
                case 'weekly':
                    $sql .= "CONCAT(YEAR(s.created), '-W', WEEK(s.created)) AS period, ";
                    break;
                case 'monthly':
                    $sql .= "DATE_FORMAT(s.created, '%Y-%m') AS period, ";
                    break;
                case 'quarterly':
                    $sql .= "CONCAT(YEAR(s.created), '-Q', QUARTER(s.created)) AS period, ";
                    break;
            }
            
            $sql .= "SUM(s.total_amount) AS revenue 
                    FROM sales s 
                    WHERE s.deleted = 0";
                    
            if ($shop_id) {
                $sql .= " AND s.shop_id = :shop_id";
            }
            
            $sql .= " GROUP BY period ORDER BY period";
            
            $stmt = $pdo->prepare($sql);
            if ($shop_id) $stmt->bindParam(':shop_id', $shop_id);
            $stmt->execute();
            
            $response['data'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            break;
            
        case 'top_products':
            $limit = $_GET['limit'] ?? 10;
            $period = $_GET['period'] ?? 'current_month';
            
            $sql = "SELECT p.name, SUM(si.subtotal) AS revenue 
                    FROM salesitems si
                    JOIN products p ON si.product_id = p.id
                    JOIN sales s ON si.sale_id = s.id
                    WHERE s.deleted = 0";
            
            // Add date filtering based on period
            switch($period) {
                case 'current_month':
                    $sql .= " AND MONTH(s.created) = MONTH(CURRENT_DATE()) 
                             AND YEAR(s.created) = YEAR(CURRENT_DATE())";
                    break;
                case 'last_month':
                    $sql .= " AND MONTH(s.created) = MONTH(DATE_SUB(CURRENT_DATE(), INTERVAL 1 MONTH))
                             AND YEAR(s.created) = YEAR(DATE_SUB(CURRENT_DATE(), INTERVAL 1 MONTH))";
                    break;
                case 'current_year':
                    $sql .= " AND YEAR(s.created) = YEAR(CURRENT_DATE())";
                    break;
            }
            
            $sql .= " GROUP BY p.name 
                     ORDER BY revenue DESC 
                     LIMIT :limit";
            
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
            $stmt->execute();
            
            $response['data'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            break;
            
        case 'key_metrics':
            // AOV (Average Order Value)
            $sql = "SELECT 
                       AVG(total_amount) AS aov,
                       (SELECT AVG(total_amount) 
                        FROM sales 
                        WHERE created >= DATE_SUB(CURRENT_DATE(), INTERVAL 1 MONTH)
                        AND created < CURRENT_DATE()) AS prev_aov
                    FROM sales
                    WHERE created >= CURRENT_DATE() - INTERVAL 30 DAY";
            $stmt = $pdo->query($sql);
            $aov = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Conversion Rate (example)
            $sql = "SELECT 
                       (COUNT(DISTINCT CASE WHEN status_id = 3 THEN customer_id END) / 
                        COUNT(DISTINCT customer_id)) * 100 AS conversion_rate
                    FROM sales";
            $stmt = $pdo->query($sql);
            $cr = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $response['data'] = [
                'aov' => $aov,
                'conversion_rate' => $cr
            ];
            break;
            
        default:
            $response['error'] = 'Invalid action';
            break;
    }
} catch(PDOException $e) {
    $response['error'] = $e->getMessage();
}

echo json_encode($response);
?>