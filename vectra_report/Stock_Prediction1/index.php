<!DOCTYPE html>
<html>
<head>
    <title>Stock Turnover Prediction</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div style="width: 800px; margin: auto;">
        <canvas id="salesChart"></canvas>
        <div id="metrics" style="margin-top: 20px; font-family: Arial;">
            <h3>Stock Prediction Metrics</h3>
            <p><strong>Current Stock:</strong> <span id="currentStock"></span></p>
            <p><strong>Forecasted Daily Sales:</strong> <span id="forecastSales"></span></p>
            <p><strong>Days Until Stockout:</strong> <span id="daysLeft"></span></p>
        </div>
    </div>

    <script>
        fetch('stock_forecast.php?product_id=123')
            .then(response => response.json())
            .then(data => {
                // Update metrics
                document.getElementById('currentStock').textContent = data.currentStock;
                document.getElementById('forecastSales').textContent = data.forecastDailySales;
                document.getElementById('daysLeft').textContent = data.daysOfInventory;

                // Chart
                const ctx = document.getElementById('salesChart').getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: data.dates,
                        datasets: [
                            {
                                label: 'Daily Sales (Units)',
                                data: data.sales,
                                borderColor: 'rgba(75, 192, 192, 1)',
                                tension: 0.1,
                                fill: false
                            },
                            {
                                label: 'Forecasted Daily Sales (WMA)',
                                data: Array(data.sales.length).fill(data.forecastDailySales),
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderDash: [5, 5],
                                fill: false
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: { beginAtZero: true, title: { display: true, text: 'Units Sold' } },
                            x: { title: { display: true, text: 'Date' } }
                        },
                        plugins: {
                            title: { 
                                display: true, 
                                text: `Stock Depletion Forecast: ${Math.round(data.daysOfInventory)} Days Remaining` 
                            },
                            annotation: {
                                annotations: {
                                    line1: {
                                        type: 'line',
                                        yMin: data.forecastDailySales,
                                        yMax: data.forecastDailySales,
                                        borderColor: 'rgba(255, 99, 132, 1)',
                                        borderWidth: 2,
                                        borderDash: [5, 5],
                                        label: {
                                            content: 'Forecasted Sales',
                                            enabled: true
                                        }
                                    }
                                }
                            }
                        }
                    }
                });
            });
    </script>
</body>
</html>