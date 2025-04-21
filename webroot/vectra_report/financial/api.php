<?php
require_once 'config.php';
//require_once 'functions.php';

header('Content-Type: application/json');

$action = $_GET['action'] ?? '';

try {
    switch ($action) {
        case 'getShops':
            $stmt = $pdo->query("SELECT id, name FROM shops WHERE deleted = 0");
            echo json_encode($stmt->fetchAll());
            break;
            
        case 'getInventoryValuation':
            $shopId = $_GET['shopId'] ?? null;
            $data = getInventoryValuation($pdo, $shopId === 'all' ? null : $shopId);
            echo json_encode($data);
            break;
            
        case 'getCOGSData':
            $startDate = $_GET['startDate'];
            $endDate = $_GET['endDate'];
            $shopId = $_GET['shopId'] ?? null;
            
            $sql = "SELECT 
                        DATE_FORMAT(s.created, '%Y-%m') AS month,
                        SUM(si.subtotal) AS revenue,
                        SUM(si.qty * COALESCE(psi.price, pp.wholesale_price)) AS cogs,
                        (SUM(si.subtotal) - SUM(si.qty * COALESCE(psi.price, pp.wholesale_price))) AS gross_profit,
                        (SUM(si.subtotal) - SUM(si.qty * COALESCE(psi.price, pp.wholesale_price))) / SUM(si.subtotal) * 100 AS gross_margin
                    FROM salesitems si
                    JOIN sales s ON si.sale_id = s.id
                    JOIN products p ON si.product_id = p.id
                    LEFT JOIN purchasesitems psi ON p.id = psi.product_id
                    LEFT JOIN pricings pp ON p.id = pp.product_id
                    WHERE s.created BETWEEN :start_date AND :end_date";
            
            if ($shopId && $shopId !== 'all') {
                $sql .= " AND s.shop_id = :shop_id";
            }
            
            $sql .= " GROUP BY month ORDER BY month";
            
            $stmt = $pdo->prepare($sql);
            $params = ['start_date' => $startDate, 'end_date' => $endDate];
            if ($shopId && $shopId !== 'all') {
                $params['shop_id'] = $shopId;
            }
            $stmt->execute($params);
            
            echo json_encode($stmt->fetchAll());
            break;
            
        case 'getStockMovement':
            $startDate = $_GET['startDate'];
            $endDate = $_GET['endDate'];
            $shopId = $_GET['shopId'] ?? null;

            $useShop = $shopId && $shopId !== 'all';
            
            $sql = "SELECT 
                        p.id,
                        p.name AS product_name,
                        COALESCE((
                            SELECT SUM(si.qty) 
                            FROM stockinsdetails si
                            JOIN stockins s ON si.stockin_id = s.id
                            WHERE si.product_id = p.id
                            AND s.created < :start_date1
                            " . ($shopId && $shopId !== 'all' ? " AND s.shop_id = :shop_id1" : "") . "
                        ), 0) AS starting_stock,
                        COALESCE((
                            SELECT SUM(si.qty) 
                            FROM stockinsdetails si
                            JOIN stockins s ON si.stockin_id = s.id
                            WHERE si.product_id = p.id
                            AND s.created BETWEEN :start_date2 AND :end_date1
                            " . ($shopId && $shopId !== 'all' ? " AND s.shop_id = :shop_id2" : "") . "
                        ), 0) AS stock_in,
                        COALESCE((
                            SELECT SUM(si.qty) 
                            FROM salesitems si
                            JOIN sales s ON si.sale_id = s.id
                            WHERE si.product_id = p.id
                            AND s.created BETWEEN :start_date3 AND :end_date2
                            " . ($shopId && $shopId !== 'all' ? " AND s.shop_id = :shop_id3" : "") . "
                        ), 0) AS stock_out,
                        COALESCE((
                            SELECT SUM(si.qty) 
                            FROM stockinsdetails si
                            JOIN stockins s ON si.stockin_id = s.id
                            WHERE si.product_id = p.id
                            AND s.created <= :end_date3
                            " . ($shopId && $shopId !== 'all' ? " AND s.shop_id = :shop_id4" : "") . "
                        ), 0) - COALESCE((
                            SELECT SUM(si.qty) 
                            FROM salesitems si
                            JOIN sales s ON si.sale_id = s.id
                            WHERE si.product_id = p.id
                            AND s.created <= :end_date4
                            " . ($shopId && $shopId !== 'all' ? " AND s.shop_id = :shop_id5" : "") . "
                        ), 0) AS ending_stock
                    FROM products p
                    WHERE p.deleted = 0
                    ORDER BY ending_stock DESC
                    LIMIT 10";
            
            $stmt = $pdo->prepare($sql);
            $params['start_date1'] = $startDate;
            $params['start_date2'] = $startDate;
            $params['start_date3'] = $startDate;
            $params['end_date1'] = $endDate;
            $params['end_date2'] = $endDate;
            $params['end_date3'] = $endDate;
            $params['end_date4'] = $endDate;
            if ($shopId && $shopId !== 'all') {
                $params['shop_id1'] = $shopId;
                $params['shop_id2'] = $shopId;
                $params['shop_id3'] = $shopId;
                $params['shop_id4'] = $shopId;
                $params['shop_id5'] = $shopId;
            }
            $stmt->execute($params);
            
            echo json_encode($stmt->fetchAll());
            break;
            
        case 'getPurchasesExpenses':
            $startDate = $_GET['startDate'];
            $endDate = $_GET['endDate'];
            $shopId = $_GET['shopId'] ?? null;
            
            $sql = "SELECT 
                        DATE_FORMAT(p.created, '%Y-%m') AS month,
                        COALESCE(SUM(p.total_amount), 0) AS total_purchases,
                        COALESCE((
                            SELECT SUM(e.amount)
                            FROM expenses e
                            WHERE DATE_FORMAT(e.created, '%Y-%m') = DATE_FORMAT(p.created, '%Y-%m')
                            " . ($shopId && $shopId !== 'all' ? " AND e.shop_id = :shop_id" : "") . "
                        ), 0) AS total_expenses
                    FROM purchases p
                    WHERE p.created BETWEEN :start_date AND :end_date
                    " . ($shopId && $shopId !== 'all' ? " AND p.shop_id = :shop_id" : "") . "
                    GROUP BY month
                    ORDER BY month";
            
            $stmt = $pdo->prepare($sql);
            $params = ['start_date' => $startDate, 'end_date' => $endDate];
            if ($shopId && $shopId !== 'all') {
                $params['shop_id'] = $shopId;
            }
            $stmt->execute($params);
            
            echo json_encode($stmt->fetchAll());
            break;
            
        case 'getOutstandingLiabilities':
            $shopId = $_GET['shopId'] ?? null;
            
            $sql = "SELECT 
                        COALESCE(SUM(p.total_amount - COALESCE((
                            SELECT SUM(ps.amount)
                            FROM paymentstosuppliers ps
                            WHERE ps.purchase_id = p.id
                        ), 0)), 0) AS total_liabilities
                    FROM purchases p
                    WHERE p.deleted = 0
                    AND p.total_amount > COALESCE((
                        SELECT SUM(ps.amount)
                        FROM paymentstosuppliers ps
                        WHERE ps.purchase_id = p.id
                    ), 0)";
            
            if ($shopId && $shopId !== 'all') {
                $sql .= " AND p.shop_id = :shop_id";
            }
            
            $stmt = $pdo->prepare($sql);
            $params = [];
            if ($shopId && $shopId !== 'all') {
                $params['shop_id'] = $shopId;
            }
            $stmt->execute($params);
            
            $result = $stmt->fetch();
            echo json_encode($result);
            break;
            
        default:
            throw new Exception('Invalid action');
    }
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['error' => $e->getMessage()]);
}
?>