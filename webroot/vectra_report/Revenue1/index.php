<!DOCTYPE html>
<html>
<head>
    <title>Revenue Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/luxon@3.0.1"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-luxon@1.2.0"></script>
</head>
<body>
    <div style="width: 80%; margin: auto;">
        <h1>Revenue Analytics</h1>
        
        <!-- Metric Cards -->
        <div style="display: flex; gap: 20px; margin-bottom: 30px;">
            <div id="revenueGrowth" style="flex: 1; padding: 20px; background: #f5f5f5; border-radius: 10px;">
                <h3>YoY Growth</h3>
                <p id="yoyGrowth">Loading...</p>
            </div>
            <div id="totalRevenue" style="flex: 1; padding: 20px; background: #f5f5f5; border-radius: 10px;">
                <h3>Current Month Revenue</h3>
                <p id="currentRevenue">Loading...</p>
            </div>
        </div>

        <!-- Charts -->
        <canvas id="monthlyRevenueChart"></canvas>
        <canvas id="revenueByShopChart" style="margin-top: 40px;"></canvas>
        <canvas id="topProductsChart" style="margin-top: 40px;"></canvas>
    </div>

    <script>
        // Fetch data from PHP backend
        fetch('revenue_metrics.php')
            .then(response => response.json())
            .then(data => {
                renderMetrics(data);
                renderCharts(data);
            });

        // Update metric cards
        function renderMetrics(data) {
            const latestMonth = data.monthlyRevenue[0];
            const yoyGrowth = ((latestMonth.revenue - latestMonth.revenue_prev_year) / latestMonth.revenue_prev_year * 100).toFixed(2);
            document.getElementById('yoyGrowth').textContent = `${yoyGrowth}%`;
            document.getElementById('currentRevenue').textContent = `$${latestMonth.revenue.toLocaleString()}`;
        }

        // Render charts
        function renderCharts(data) {
            // Monthly Revenue Trend (Line Chart)
            new Chart(
                document.getElementById('monthlyRevenueChart'),
                {
                    type: 'line',
                    data: {
                        labels: data.monthlyRevenue.map(row => row.month),
                        datasets: [
                            {
                                label: 'Revenue',
                                data: data.monthlyRevenue.map(row => row.revenue),
                                borderColor: 'rgb(75, 192, 192)',
                                tension: 0.1
                            },
                            {
                                label: 'Previous Year',
                                data: data.monthlyRevenue.map(row => row.revenue_prev_year),
                                borderColor: 'rgb(255, 99, 132)',
                                borderDash: [5, 5]
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            title: {
                                display: true,
                                text: 'Monthly Revenue Trend (YoY Comparison)'
                            },
                            tooltip: {
                                callbacks: {
                                    label: (context) => `$${context.raw.toLocaleString()}`
                                }
                            }
                        },
                        scales: {
                            y: {
                                ticks: {
                                    callback: (value) => `$${value.toLocaleString()}`
                                }
                            }
                        }
                    }
                }
            );

            // Revenue by Shop (Bar Chart)
            new Chart(
                document.getElementById('revenueByShopChart'),
                {
                    type: 'bar',
                    data: {
                        labels: data.revenueByShop.map(row => row.shop),
                        datasets: [{
                            label: 'Revenue (Last 6 Months)',
                            data: data.revenueByShop.map(row => row.revenue),
                            backgroundColor: 'rgba(54, 162, 235, 0.6)'
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            title: {
                                display: true,
                                text: 'Revenue by Shop'
                            }
                        }
                    }
                }
            );

            // Top Products (Doughnut Chart)
            new Chart(
                document.getElementById('topProductsChart'),
                {
                    type: 'doughnut',
                    data: {
                        labels: data.topProducts.map(row => row.product),
                        datasets: [{
                            label: 'Revenue',
                            data: data.topProducts.map(row => row.revenue),
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.6)',
                                'rgba(54, 162, 235, 0.6)',
                                'rgba(255, 206, 86, 0.6)'
                            ]
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            title: {
                                display: true,
                                text: 'Top Products by Revenue'
                            },
                            tooltip: {
                                callbacks: {
                                    label: (context) => {
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const value = context.raw;
                                        const percentage = Math.round((value / total) * 100);
                                        return `$${value.toLocaleString()} (${percentage}%)`;
                                    }
                                }
                            }
                        }
                    }
                }
            );
        }
    </script>
</body>
</html>