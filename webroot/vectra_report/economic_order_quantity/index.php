<!DOCTYPE html>
<html>
<head>
    <title>EOQ Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .dashboard { max-width: 1200px; margin: 0 auto; }
        .chart-container { margin: 20px; padding: 15px; border: 1px solid #ddd; }
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
    </style>
</head>
<body>
    <div class="dashboard">
        <h1>Inventory Optimization Dashboard</h1>
        <div class="grid">
            <div class="chart-container">
                <canvas id="eoqChart"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="costCurveChart"></canvas>
            </div>
        </div>
        <div id="productTable"></div>
    </div>

    <script>
        let eoqChart, costCurveChart;

        async function loadEOQData() {
            const response = await fetch('eoq_calculator.php');
            return await response.json();
        }

        function renderDashboard(data) {
            // Table with key metrics
            let tableHTML = `<table border="1">
                <tr>
                    <th>Product</th>
                    <th>Current Stock</th>
                    <th>EOQ</th>
                    <th>Reorder Point</th>
                    <th>Safety Stock</th>
                    <th>Total Cost</th>
                </tr>`;
            
            data.forEach(product => {
                tableHTML += `<tr>
                    <td>${product.product}</td>
                    <td>${product.current_stock}</td>
                    <td>${product.eoq}</td>
                    <td>${product.reorder_point}</td>
                    <td>${product.safety_stock}</td>
                    <td>$${product.total_cost}</td>
                </tr>`;
            });
            document.getElementById('productTable').innerHTML = tableHTML;

            // EOQ Comparison Chart
            const ctx1 = document.getElementById('eoqChart').getContext('2d');
            if (eoqChart) eoqChart.destroy();
            eoqChart = new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: data.map(p => p.product),
                    datasets: [{
                        label: 'Economic Order Quantity',
                        data: data.map(p => p.eoq),
                        backgroundColor: 'rgba(54, 162, 235, 0.6)'
                    }]
                }
            });

            // Cost Curve Chart (for first product)
            const ctx2 = document.getElementById('costCurveChart').getContext('2d');
            if (costCurveChart) costCurveChart.destroy();
            const curveData = data[0].ordering_cost_curve;
            costCurveChart = new Chart(ctx2, {
                type: 'line',
                data: {
                    labels: curveData.map(d => d.quantity),
                    datasets: [{
                        label: 'Total Cost',
                        data: curveData.map(d => d.total_cost),
                        borderColor: 'rgb(255, 99, 132)',
                        tension: 0.1
                    }, {
                        label: 'Holding Cost',
                        data: curveData.map(d => d.holding_cost),
                        borderColor: 'rgb(54, 162, 235)',
                        tension: 0.1
                    }, {
                        label: 'Ordering Cost',
                        data: curveData.map(d => d.ordering_cost),
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        annotation: {
                            annotations: {
                                eoqLine: {
                                    type: 'line',
                                    xMin: data[0].eoq,
                                    xMax: data[0].eoq,
                                    borderColor: 'red',
                                    borderWidth: 2,
                                    label: {
                                        content: 'EOQ',
                                        position: 'end'
                                    }
                                }
                            }
                        }
                    }
                }
            });
        }

        // Initial load
        loadEOQData().then(renderDashboard);
    </script>
</body>
</html>