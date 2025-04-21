<?php
// dashboard.php
require '../config.php';

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Business Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Business Dashboard</h1>
        
        <!-- Sales Section -->
        <div class="row mb-4">
            <div class="col-md-12">
                <h3>Sales Overview</h3>
                <?php
                // Monthly Sales Query
                $salesQuery = $pdo->query("
                    SELECT 
                        DATE_FORMAT(s.created, '%Y-%m') AS month,
                        SUM(s.total_amount) AS revenue
                    FROM sales s
                    WHERE s.deleted = 0
                    GROUP BY month
                    ORDER BY month DESC
                    LIMIT 12
                ");
                $salesData = $salesQuery->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <canvas id="salesChart"></canvas>
            </div>
        </div>

        <!-- Inventory Section -->
        <div class="row mb-4">
            <div class="col-md-6">
                <h3>Low Stock Alerts</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Shop</th>
                            <th>Current Stock</th>
                            <th>Min Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stockQuery = $pdo->query("
                            SELECT 
  p.name AS product,
  s.name AS shop,
  ss.stock,
  ss.stock_min
FROM shopstocks ss
JOIN products p ON ss.product_id = p.id
JOIN rooms r ON r.id = ss.room_id
JOIN shops s ON r.shops_id = s.id
WHERE ss.stock < ss.stock_min AND ss.deleted = 0
                            LIMIT 10
                        ");
                        while ($row = $stockQuery->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>
                                <td>{$row['product']}</td>
                                <td>{$row['shop']}</td>
                                <td>{$row['stock']}</td>
                                <td>{$row['stock_min']}</td>
                            </tr>";
                        }
                        $stockQuery->closeCursor();
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Attendance Section -->
            <div class="col-md-6">
                <h3>Attendance Summary</h3>
                <?php
                $attendanceQuery = $pdo->query("
                    SELECT 
                        u.firstname,
                        u.lastname,
                        COUNT(a.id) AS attendance_days,
                        SUM(TIMESTAMPDIFF(HOUR, a.check_in, a.check_out)) AS total_hours
                    FROM attendances a
                    JOIN users u ON a.affectation_id = u.id
                    WHERE a.deleted = 0
                    GROUP BY u.id
                    LIMIT 5
                ");
                $attendanceData = $attendanceQuery->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <canvas id="attendanceChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        // Sales Chart
        new Chart(document.getElementById('salesChart'), {
            type: 'line',
            data: {
                labels: <?php echo json_encode(array_column($salesData, 'month')); ?>,
                datasets: [{
                    label: 'Monthly Revenue',
                    data: <?php echo json_encode(array_column($salesData, 'revenue')); ?>,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            }
        });

        // Attendance Chart
        new Chart(document.getElementById('attendanceChart'), {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(array_map(fn($v) => $v['firstname'].' '.$v['lastname'], $attendanceData)); ?>,
                datasets: [{
                    label: 'Total Hours Worked',
                    data: <?php echo json_encode(array_column($attendanceData, 'total_hours')); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgb(54, 162, 235)',
                    borderWidth: 1
                }]
            }
        });
    </script>
</body>
</html>