<?php
require '../config.php'; // Database connection

// 1. Product Sales Performance (Top 10)
$topProducts = $pdo->query("
    SELECT 
        p.id,
        p.name,
        p.reference,
        SUM(si.qty) AS total_sold,
        SUM(si.subtotal) AS total_revenue,
        AVG(si.unit_price) AS avg_selling_price,
        (SELECT price FROM purchasesitems WHERE product_id = p.id ORDER BY created DESC LIMIT 1) AS last_cost
    FROM salesitems si
    JOIN products p ON si.product_id = p.id
    JOIN sales s ON si.sale_id = s.id
    WHERE p.deleted = 0 AND s.deleted = 0
    GROUP BY p.id
    ORDER BY total_revenue DESC
    LIMIT 10
")->fetchAll(PDO::FETCH_ASSOC);

// 2. Inventory Health Metrics
$inventoryHealth = $pdo->query("
    SELECT 
        p.name,
        ss.stock,
        ss.stock_min,
        ss.stock_max,
        (SELECT SUM(qty) FROM salesitems WHERE product_id = p.id AND created >= DATE_SUB(NOW(), INTERVAL 30 DAY)) AS monthly_sales,
        ROUND(ss.stock / (SELECT COALESCE(SUM(qty)/30, 0.01) FROM salesitems WHERE product_id = p.id AND created >= DATE_SUB(NOW(), INTERVAL 30 DAY)), 1) AS days_cover
    FROM shopstocks ss
    JOIN products p ON ss.product_id = p.id
    WHERE ss.deleted = 0 AND p.deleted = 0
    HAVING days_cover < 15 OR stock < stock_min
")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Metrics Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container mt-4">
        <h2>Product Performance Metrics</h2>
        
        <!-- Top Products Table -->
        <div class="card mb-4">
            <div class="card-header">
                <h4>Top 10 Products by Revenue</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Reference</th>
                            <th>Units Sold</th>
                            <th>Revenue</th>
                            <th>Avg. Price</th>
                            <th>Last Cost</th>
                            <th>Margin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($topProducts as $product): 
                            $margin = ($product['last_cost'] > 0) 
                                ? round(($product['avg_selling_price'] - $product['last_cost']) / $product['avg_selling_price'] * 100, 1)
                                : 0;
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($product['name']) ?></td>
                            <td><?= htmlspecialchars($product['reference']) ?></td>
                            <td><?= $product['total_sold'] ?></td>
                            <td><?= number_format($product['total_revenue'], 2) ?></td>
                            <td><?= number_format($product['avg_selling_price'], 2) ?></td>
                            <td><?= number_format($product['last_cost'], 2) ?></td>
                            <td class="<?= ($margin >= 30) ? 'text-success' : 'text-danger' ?>">
                                <?= $margin ?>%
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Inventory Health Alerts -->
        <div class="card">
            <div class="card-header bg-warning">
                <h4>Inventory Health Alerts</h4>
            </div>
            <div class="card-body">
                <canvas id="inventoryChart"></canvas>
                <table class="table table-sm mt-3">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Current Stock</th>
                            <th>Min Stock</th>
                            <th>30-Day Sales</th>
                            <th>Days Cover</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($inventoryHealth as $item): ?>
                        <tr class="<?= ($item['days_cover'] < 7) ? 'table-danger' : '' ?>">
                            <td><?= htmlspecialchars($item['name']) ?></td>
                            <td><?= $item['stock'] ?></td>
                            <td><?= $item['stock_min'] ?></td>
                            <td><?= $item['monthly_sales'] ?? 0 ?></td>
                            <td><?= $item['days_cover'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Inventory Health Chart
        new Chart(document.getElementById('inventoryChart'), {
            type: 'bar',
            data: {
                labels: <?= json_encode(array_column($inventoryHealth, 'name')) ?>,
                datasets: [{
                    label: 'Days of Inventory Cover',
                    data: <?= json_encode(array_column($inventoryHealth, 'days_cover')) ?>,
                    backgroundColor: (ctx) => ctx.raw < 7 ? 'rgba(220, 53, 69, 0.7)' : 'rgba(25, 135, 84, 0.7)'
                }]
            },
            options: {
                scales: { y: { beginAtZero: true } },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: (ctx) => `${ctx.raw} days remaining`
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>