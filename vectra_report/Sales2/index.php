<!DOCTYPE html>
<html>
<head>
    <title>Advanced Sales Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/luxon@3.0.1"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-luxon@1.0.0"></script>
</head>
<body>
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
        <!-- Chart 1: Sales Trend -->
        <canvas id="salesTrendChart" height="300"></canvas>
        
        <!-- Chart 2: Top Products -->
        <canvas id="topProductsChart" height="300"></canvas>
        
        <!-- Chart 3: Sales by Hour -->
        <canvas id="salesByHourChart" height="300"></canvas>
    </div>

    <script>
        // Fetch data from PHP backend
        async function fetchData(action) {
            const response = await fetch(`sales_api.php?action=${action}`);
            return await response.json();
        }

        // Initialize all charts
        async function initCharts() {
            const salesTrend = await fetchData('sales_trend');
            const topProducts = await fetchData('top_products');
            const salesByHour = await fetchData('sales_by_hour');

            // Chart 1: Sales Trend (Line Chart)
            new Chart(
                document.getElementById('salesTrendChart'),
                {
                    type: 'line',
                    data: {
                        labels: salesTrend.map(row => row.month),
                        datasets: [
                            {
                                label: 'Revenue ($)',
                                data: salesTrend.map(row => row.revenue),
                                borderColor: 'rgba(75, 192, 192, 1)',
                                tension: 0.3,
                                yAxisID: 'y'
                            },
                            {
                                label: 'Unique Customers',
                                data: salesTrend.map(row => row.unique_customers),
                                borderColor: 'rgba(153, 102, 255, 1)',
                                tension: 0.3,
                                yAxisID: 'y1'
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: { type: 'linear', position: 'left' },
                            y1: { type: 'linear', position: 'right' }
                        }
                    }
                }
            );

            // Chart 2: Top Products (Bar Chart)
            new Chart(
                document.getElementById('topProductsChart'),
                {
                    type: 'bar',
                    data: {
                        labels: topProducts.map(row => row.product),
                        datasets: [
                            {
                                label: 'Revenue ($)',
                                data: topProducts.map(row => row.revenue),
                                backgroundColor: 'rgba(54, 162, 235, 0.6)'
                            },
                            {
                                label: 'Units Sold',
                                data: topProducts.map(row => row.units_sold),
                                backgroundColor: 'rgba(255, 159, 64, 0.6)'
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        scales: { x: { stacked: true }, y: { stacked: false } }
                    }
                }
            );

            // Chart 3: Sales by Hour (Radar Chart)
            new Chart(
                document.getElementById('salesByHourChart'),
                {
                    type: 'radar',
                    data: {
                        labels: salesByHour.map(row => `${row.hour}:00`),
                        datasets: [
                            {
                                label: 'Revenue by Hour ($)',
                                data: salesByHour.map(row => row.revenue),
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderColor: 'rgba(255, 99, 132, 1)'
                            }
                        ]
                    },
                    options: { responsive: true }
                }
            );
        }

        // Initialize dashboard on load
        window.onload = initCharts;
    </script>
</body>
</html>