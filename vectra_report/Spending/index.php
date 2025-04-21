<?php
require '../config.php';

// Get date range (e.g., current month)
$startDate = date('Y-m-01');
$endDate = date('Y-m-t');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Advanced Stock Analytics</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/luxon@3.0.1"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-luxon@1.2.0"></script>
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Spending Analytics Dashboard</h2>
    
    <!-- 1. Spending Overview Cards -->
    <div class="row mb-4">
        <?php
        // Total Spending
        $totalSpent = $pdo->query("
            SELECT SUM(amount) AS total 
            FROM expenses 
            WHERE deleted = 0
            AND created BETWEEN '$startDate' AND '$endDate'
        ")->fetchColumn();

        // Spending by Type
        $spendingByType = $pdo->query("
            SELECT et.name, SUM(e.amount) AS total
            FROM expenses e
            JOIN expensestypes et ON e.expensestype_id = et.id
            WHERE e.deleted = 0
            GROUP BY et.name
            ORDER BY total DESC
        ")->fetchAll(PDO::FETCH_ASSOC);
        ?>
        
        <div class="col-md-4">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5>Total Spent</h5>
                    <h2><?= number_format($totalSpent, 2) ?> USD</h2>
                    <small>Current Month</small>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <canvas id="spendingByTypeChart"></canvas>
        </div>
    </div>

    <!-- 2. Supplier Spending Analysis -->
    <div class="row mb-4">
        <div class="col-md-12">
            <h3>Supplier Expenditure</h3>
            <?php
            $supplierSpending = $pdo->query("
                SELECT 
                    s.name AS supplier,
                    SUM(pi.price * pi.qty) AS total_spent,
                    COUNT(DISTINCT p.id) AS purchase_orders
                FROM purchasesitems pi
                JOIN purchases p ON pi.purchase_id = p.id
                JOIN suppliers s ON p.supplier_id = s.id
                WHERE p.deleted = 0
                GROUP BY s.name
                ORDER BY total_spent DESC
                LIMIT 10
            ")->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Supplier</th>
                        <th>Total Spent</th>
                        <th>Orders</th>
                        <th>Avg. Order Value</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($supplierSpending as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['supplier']) ?></td>
                        <td><?= number_format($row['total_spent'], 2) ?></td>
                        <td><?= $row['purchase_orders'] ?></td>
                        <td><?= number_format($row['total_spent'] / max(1, $row['purchase_orders']), 2) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- 3. Budget vs Actual -->
    <div class="row">
        <div class="col-md-12">
            <h3>Budget Compliance</h3>
            <?php
            $budgetAnalysis = $pdo->query("
                SELECT 
                    et.name,
                    et.monthy_amount AS budget,
                    SUM(e.amount) AS actual,
                    (SUM(e.amount) / et.monthy_amount) * 100 AS percentage
                FROM expensestypes et
                LEFT JOIN expenses e ON et.id = e.expensestype_id
                    AND e.created BETWEEN '$startDate' AND '$endDate'
                    AND e.deleted = 0
                WHERE et.deleted = 0
                GROUP BY et.id
                HAVING budget > 0
            ")->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <canvas id="budgetChart" height="100"></canvas>
        </div>
    </div>
</div>

<script>
// 1. Spending by Type Chart
new Chart(document.getElementById('spendingByTypeChart'), {
    type: 'doughnut',
    data: {
        labels: <?= json_encode(array_column($spendingByType, 'name')) ?>,
        datasets: [{
            data: <?= json_encode(array_column($spendingByType, 'total')) ?>,
            backgroundColor: [
                '#ff6384', '#36a2eb', '#ffce56', '#4bc0c0', '#9966ff'
            ]
        }]
    }
});

// 2. Budget Compliance Chart
new Chart(document.getElementById('budgetChart'), {
    type: 'bar',
    data: {
        labels: <?= json_encode(array_column($budgetAnalysis, 'name')) ?>,
        datasets: [
            {
                label: 'Budget',
                data: <?= json_encode(array_column($budgetAnalysis, 'budget')) ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.6)'
            },
            {
                label: 'Actual',
                data: <?= json_encode(array_column($budgetAnalysis, 'actual')) ?>,
                backgroundColor: 'rgba(255, 99, 132, 0.6)'
            }
        ]
    },
    options: {
        scales: {
            x: { stacked: true },
            y: { stacked: true }
        }
    }
});
</script>
</body>
</html>