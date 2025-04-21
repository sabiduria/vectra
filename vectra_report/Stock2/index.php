<!DOCTYPE html>
<html>
<head>
    <title>Advanced Stock Analytics</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/luxon@3.0.1"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-luxon@1.2.0"></script>
</head>
<body>
    <div id="filters">
        <select id="timeframe">
            <option value="7d">Last 7 Days</option>
            <option value="30d" selected>Last 30 Days</option>
            <option value="90d">Last 90 Days</option>
        </select>
        <button id="refresh">Refresh</button>
    </div>

    <div class="chart-container" style="height:60vh; width:80vw">
        <canvas id="turnoverChart"></canvas>
    </div>

    <script>
        async function loadStockData() {
            const timeframe = document.getElementById('timeframe').value;
            const response = await fetch(`stock_metrics.php?timeframe=${timeframe}`);
            
            if (!response.ok) {
                alert('Failed to load data');
                return;
            }
            
            const data = await response.json();
            renderCharts(data);
        }

        function renderCharts(data) {
            // Turnover Ratio Chart
            const ctx = document.getElementById('turnoverChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.data.turnover_analysis.map(item => item.name),
                    datasets: [{
                        label: 'Stock Turnover Ratio',
                        data: data.data.turnover_analysis.map(item => item.turnover_ratio),
                        backgroundColor: (ctx) => {
                            const ratio = ctx.raw;
                            return ratio < 0.5 ? '#ff6384' : 
                                   ratio < 1.5 ? '#36a2eb' : '#4bc0c0';
                        }
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: (ctx) => {
                                    const item = data.data.turnover_analysis[ctx.dataIndex];
                                    return [
                                        `Turnover: ${ctx.raw.toFixed(2)}`,
                                        `Avg Stock: ${item.avg_stock}`,
                                        `Sold: ${item.sold_quantity}`
                                    ];
                                }
                            }
                        }
                    }
                }
            });
        }

        document.getElementById('refresh').addEventListener('click', loadStockData);
        loadStockData(); // Initial load
    </script>
</body>
</html>