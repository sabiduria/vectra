<!DOCTYPE html>
<html>
<head>
    <title>Advanced Stock Alerts</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/luxon@3.0.1"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-luxon@1.2.0"></script>
</head>
<body>
    <div style="display: flex;">
        <!-- Chart Container -->
        <div style="width: 60%;">
            <canvas id="stockChart"></canvas>
        </div>
        <!-- Alert Table -->
        <div style="width: 40%; padding: 10px;">
            <table id="alertTable" border="1">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Stock</th>
                        <th>Min Stock</th>
                        <th>Days Left</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <script>
        // Fetch data from PHP backend
        async function fetchStockData() {
            const response = await fetch('stock_alerts.php');
            return await response.json();
        }

        // Render Chart
        async function renderChart() {
            const data = await fetchStockData();
            const ctx = document.getElementById('stockChart').getContext('2d');

            // Group by alert level
            const critical = data.filter(item => item.alert_level === 'critical');
            const warning = data.filter(item => item.alert_level === 'warning');
            const healthy = data.filter(item => item.alert_level === 'healthy');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Critical', 'Warning', 'Healthy'],
                    datasets: [{
                        label: 'Stock Alerts',
                        data: [critical.length, warning.length, healthy.length],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.7)',
                            'rgba(255, 206, 86, 0.7)',
                            'rgba(75, 192, 192, 0.7)'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: { text: 'Stock Alert Distribution', display: true }
                    }
                }
            });

            // Populate table
            const tableBody = document.querySelector('#alertTable tbody');
            tableBody.innerHTML = data.map(item => `
                <tr style="color: ${
                    item.alert_level === 'critical' ? 'red' : 
                    item.alert_level === 'warning' ? 'orange' : 'green'
                }">
                    <td>${item.name}</td>
                    <td>${item.stock}</td>
                    <td>${item.stock_min}</td>
                    <td>${item.days_of_stock_left}</td>
                    <td>${item.alert_level.toUpperCase()}</td>
                </tr>
            `).join('');
        }

        // Auto-refresh every 5 minutes
        renderChart();
        setInterval(renderChart, 300000);
    </script>
</body>
</html>