<?php
// config.php (same as previous)
// dashboard_advanced.php
require '../config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Advanced Financial Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/luxon@3.0.1"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-luxon@1.1.0"></script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Financial & Operational Dashboard</h1>

        <!-- Purchases Metrics -->
        <div class="row mb-4">
            <div class="col-md-12">
                <h3>Purchasing Analytics</h3>
                <?php
                // Supplier Spend Analysis
                $purchaseQuery = $pdo->query("
                    SELECT 
                        s.name AS supplier,
                        COUNT(p.id) AS total_orders,
                        SUM(pi.qty * pi.price) AS total_spend,
                        AVG(DATEDIFF(p.receipt_date, p.due_date)) AS avg_delivery_delay
                    FROM purchases p
                    JOIN purchasesitems pi ON p.id = pi.purchase_id
                    JOIN suppliers s ON p.supplier_id = s.id
                    WHERE p.deleted = 0
                    GROUP BY s.id
                    ORDER BY total_spend DESC
                    LIMIT 10
                ");
                $purchaseData = $purchaseQuery->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <canvas id="supplierSpendChart"></canvas>
            </div>
        </div>

        <!-- Expenses vs Payroll -->
        <div class="row mb-4">
            <div class="col-md-6">
                <h4>Monthly Expenses Breakdown</h4>
                <?php
                $expenseQuery = $pdo->query("
                    SELECT 
                        et.name AS expense_type,
                        SUM(e.amount) AS total,
                        et.monthy_amount AS budget
                    FROM expenses e
                    JOIN expensestypes et ON e.expensestype_id = et.id
                    WHERE e.deleted = 0
                    GROUP BY et.id
                ");
                $expenseData = $expenseQuery->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <canvas id="expenseChart"></canvas>
            </div>

            <div class="col-md-6">
                <h4>Payroll Analysis</h4>
                <?php
                $payrollQuery = $pdo->query("
                    SELECT 
                        CONCAT(u.firstname, ' ', u.lastname) AS employee,
                        SUM(p.period_salary) AS gross_salary,
                        SUM(p.deductions) AS total_deductions,
                        SUM(p.bonus) AS total_bonus
                    FROM payrolls p
                    JOIN users u ON p.salary_id = u.id
                    WHERE p.deleted = 0
                    GROUP BY u.id
                    LIMIT 10
                ");
                $payrollData = $payrollQuery->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <canvas id="payrollChart"></canvas>
            </div>
        </div>

        <!-- Order Fulfillment -->
        <div class="row mb-4">
            <div class="col-md-12">
                <h3>Order Performance</h3>
                <?php
                $orderQuery = $pdo->query("
                    SELECT 
                        st.name AS status,
                        COUNT(o.id) AS order_count,
                        AVG(DATEDIFF(o.modified, o.created)) AS avg_fulfillment_time,
                        SUM(oi.qty * oi.unit_price) AS total_value
                    FROM orders o
                    JOIN ordersitems oi ON o.id = oi.order_id
                    JOIN statuses st ON o.status_id = st.id
                    WHERE o.deleted = 0
                    GROUP BY st.id
                ");
                $orderData = $orderQuery->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <div class="row">
                    <div class="col-md-6">
                        <canvas id="orderStatusChart"></canvas>
                    </div>
                    <div class="col-md-6">
                        <canvas id="fulfillmentTimeChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Purchasing Analytics (Horizontal Bar)
        new Chart(document.getElementById('supplierSpendChart'), {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(array_column($purchaseData, 'supplier')); ?>,
                datasets: [{
                    label: 'Total Spend',
                    data: <?php echo json_encode(array_column($purchaseData, 'total_spend')); ?>,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgb(255, 99, 132)',
                    borderWidth: 1
                },{
                    label: 'Avg Delivery Delay (Days)',
                    data: <?php echo json_encode(array_column($purchaseData, 'avg_delivery_delay')); ?>,
                    type: 'line',
                    borderColor: 'rgb(54, 162, 235)',
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    x: { beginAtZero: true },
                    y: { type: 'linear', position: 'left' }
                }
            }
        });

        // Expense vs Budget (Radar)
        new Chart(document.getElementById('expenseChart'), {
            type: 'radar',
            data: {
                labels: <?php echo json_encode(array_column($expenseData, 'expense_type')); ?>,
                datasets: [{
                    label: 'Actual Spend',
                    data: <?php echo json_encode(array_column($expenseData, 'total')); ?>,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)'
                },{
                    label: 'Monthly Budget',
                    data: <?php echo json_encode(array_column($expenseData, 'budget')); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)'
                }]
            }
        });

        // Payroll Breakdown (Stacked Bar)
        new Chart(document.getElementById('payrollChart'), {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(array_column($payrollData, 'employee')); ?>,
                datasets: [{
                    label: 'Gross Salary',
                    data: <?php echo json_encode(array_column($payrollData, 'gross_salary')); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.5)'
                },{
                    label: 'Deductions',
                    data: <?php echo json_encode(array_column($payrollData, 'total_deductions')); ?>,
                    backgroundColor: 'rgba(255, 99, 132, 0.5)'
                },{
                    label: 'Bonuses',
                    data: <?php echo json_encode(array_column($payrollData, 'total_bonus')); ?>,
                    backgroundColor: 'rgba(153, 102, 255, 0.5)'
                }]
            },
            options: {
                scales: {
                    x: { stacked: true },
                    y: { stacked: true }
                }
            }
        });

        // Order Status Distribution (Doughnut)
        new Chart(document.getElementById('orderStatusChart'), {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode(array_column($orderData, 'status')); ?>,
                datasets: [{
                    data: <?php echo json_encode(array_column($orderData, 'order_count')); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)'
                    ]
                }]
            }
        });
    </script>
</body>
</html>