<!DOCTYPE html>
<html>
<head>
    <title>Advanced Stock Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    <div style="width: 80%; margin: auto;">
        <h2>Stock Levels vs. Thresholds</h2>
        <canvas id="stockLevelsChart"></canvas>
        
        <h2>Inventory Turnover Rate</h2>
        <canvas id="turnoverChart"></canvas>
    </div>

    <script>
        // Fetch data from PHP API
        axios.get('stock_metrics2.php')
            .then(response => {
                const data = response.data;
                renderStockLevelsChart(data.stockLevels);
                renderTurnoverChart(data.turnoverData);
            });

        // Chart 1: Stock Levels vs. Thresholds
        function renderStockLevelsChart(data) {
            const ctx = document.getElementById('stockLevelsChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.map(item => item.product),
                    datasets: [
                        {
                            label: 'Current Stock',
                            data: data.map(item => item.stock),
                            backgroundColor: 'rgba(54, 162, 235, 0.6)'
                        },
                        {
                            label: 'Min Stock',
                            data: data.map(item => item.stock_min),
                            backgroundColor: 'rgba(255, 99, 132, 0.6)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1,
                            type: 'line'
                        }
                    ]
                },
                options: {
                    scales: {
                        y: { beginAtZero: true }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: (ctx) => `${ctx.dataset.label}: ${ctx.raw} (Fill Rate: ${data[ctx.dataIndex].fill_rate}%)`
                            }
                        }
                    }
                }
            });
        }

        // Chart 2: Inventory Turnover
        function renderTurnoverChart(data) {
            const ctx = document.getElementById('turnoverChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.map(item => item.product),
                    datasets: [
                        {
                            label: 'Turnover Rate (Sold/Avg Stock)',
                            data: data.map(item => item.turnover_rate),
                            backgroundColor: 'rgba(75, 192, 192, 0.6)'
                        }
                    ]
                },
                options: {
                    scales: {
                        y: { beginAtZero: true }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                afterLabel: (ctx) => 
                                    `Sold: ${data[ctx.dataIndex].sold_qty} | Avg Stock: ${data[ctx.dataIndex].avg_stock}`
                            }
                        }
                    }
                }
            });
        }
    </script>
</body>
</html>