<!DOCTYPE html>
<html>
<head>
    <title>Advanced Business Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation"></script>
    <style>
        .dashboard-container {
            width: 900px;
            margin: 20px auto;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .chart-container {
            position: relative;
            height: 400px;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h2>Business Performance Dashboard</h2>
        <div class="chart-container">
            <canvas id="comboChart"></canvas>
        </div>
    </div>

    <script>
        // Fetch data from PHP API
        fetch('metrics_api.php')
            .then(response => response.json())
            .then(data => {
                renderComboChart(data);
            });

        function renderComboChart(data) {
            const months = data.map(item => item.month);
            const sales = data.map(item => item.sales);
            const profits = data.map(item => item.profit);
            const growthRates = data.map(item => item.growth_rate);

            const ctx = document.getElementById('comboChart').getContext('2d');
            const comboChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [
                        {
                            label: 'Sales ($)',
                            data: sales,
                            backgroundColor: 'rgba(54, 162, 235, 0.6)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1,
                            yAxisID: 'y'
                        },
                        {
                            label: 'Profit ($)',
                            data: profits,
                            backgroundColor: 'rgba(75, 192, 192, 0.6)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1,
                            type: 'bar',
                            yAxisID: 'y'
                        },
                        {
                            label: 'Growth Rate (%)',
                            data: growthRates,
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 2,
                            type: 'line',
                            fill: false,
                            yAxisID: 'y1'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Sales, Profit, and Growth Rate (MoM)'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label.includes('Growth')) {
                                        return `${label}: ${context.raw}%`;
                                    }
                                    return `${label}: $${context.raw.toLocaleString()}`;
                                }
                            }
                        },
                        annotation: {
                            annotations: {
                                line1: {
                                    type: 'line',
                                    yMin: 0,
                                    yMax: 0,
                                    borderColor: 'rgba(255, 99, 132, 0.5)',
                                    borderWidth: 2,
                                    borderDash: [4, 4]
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            type: 'linear',
                            display: true,
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Amount ($)'
                            }
                        },
                        y1: {
                            type: 'linear',
                            display: true,
                            position: 'right',
                            title: {
                                display: true,
                                text: 'Growth Rate (%)'
                            },
                            grid: {
                                drawOnChartArea: false
                            },
                            min: Math.min(...growthRates) - 5,
                            max: Math.max(...growthRates) + 5
                        }
                    }
                }
            });
        }
    </script>
</body>
</html>