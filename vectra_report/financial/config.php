<?php
// config.php - Database connection
$host = 'localhost';
$db   = 'vectra';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// functions.php - Helper functions
function getInventoryValuation($pdo, $shopId = null) {
    $sql = "SELECT 
                p.id, 
                p.name AS product_name,
                p.reference,
                ss.stock,
                pr.unit_price,
                (ss.stock * pr.unit_price) AS total_value,
                c.name AS category
            FROM shopstocks ss
            JOIN products p ON ss.product_id = p.id
            JOIN pricings pr ON p.id = pr.product_id
            JOIN categories c ON p.category_id = c.id";
    
    if ($shopId) {
        $sql .= " WHERE ss.shop_id = :shop_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['shop_id' => $shopId]);
    } else {
        $stmt = $pdo->query($sql);
    }
    
    return $stmt->fetchAll();
}

function getCOGSData($pdo, $startDate, $endDate) {
    $sql = "SELECT 
                DATE_FORMAT(s.created, '%Y-%m') AS month,
                SUM(si.subtotal) AS revenue,
                SUM(si.qty * psi.price) AS cogs,
                (SUM(si.subtotal) - SUM(si.qty * psi.price)) AS gross_profit,
                (SUM(si.subtotal) - SUM(si.qty * psi.price)) / SUM(si.subtotal) * 100 AS gross_margin
            FROM salesitems si
            JOIN sales s ON si.sale_id = s.id
            JOIN products p ON si.product_id = p.id
            JOIN purchasesitems psi ON p.id = psi.product_id
            WHERE s.created BETWEEN :start_date AND :end_date
            GROUP BY month
            ORDER BY month";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'start_date' => $startDate,
        'end_date' => $endDate
    ]);
    
    return $stmt->fetchAll();
}
?>