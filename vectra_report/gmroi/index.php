<!DOCTYPE html>
<html>
<head>
    <title>GMROI Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .dashboard { max-width: 1200px; margin: 2rem auto; padding: 20px; }
        .card { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 15px rgba(0,0,0,0.1); margin-bottom: 2rem; }
    </style>
</head>
<body>
    <div class="dashboard">
        <div class="card">
            <h1>Gross Margin ROI: <span id="gmroiValue">...</span></h1>
        </div>
        
        <div class="card">
            <canvas id="gmroiTrendChart"></canvas>
        </div>
    </div>

    <script>
        // Fetch GMROI Data
        fetch('gmroi_api.php')
            .then(response => response.json())
            .then(data => {
                // Current GMROI
                document.getElementById('gmroiValue').textContent = 
                    `${data.current_gmroi.toFixed(2)}%`;

                // Trend Chart
                const ctx = document.getElementById('gmroiTrendChart').getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: data.trends.map(t => t.month),
                        datasets: [{
                            label: 'Monthly GMROI (%)',
                            data: data.trends.map(t => parseFloat(t.gmroi).toFixed(2)),
                            borderColor: '#4BC0C0',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            tension: 0.3
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: { 
                                title: { display: true, text: 'GMROI (%)' },
                                beginAtZero: true 
                            },
                            x: { 
                                title: { display: true, text: 'Month' },
                                grid: { display: false }
                            }
                        },
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: (ctx) => `GMROI: ${ctx.parsed.y.toFixed(2)}%`
                                }
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error:', error));
    </script>
</body>
</html>