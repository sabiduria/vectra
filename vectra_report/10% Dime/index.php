<!DOCTYPE html>
<html>
<head>
    <title>Revenue Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/luxon@3.0.1"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-luxon@1.0.0"></script>
</head>
<body>
    <div style="width: 80%; margin: auto;">
        <h1>Revenue Dashboard</h1>
        
        <!-- KPI Cards -->
        <div style="display: flex; gap: 20px; margin-bottom: 30px;">
            <div style="padding: 20px; background: #f0f0f0; border-radius: 10px; flex: 1;">
                <h3>Today's Revenue</h3>
                <p id="todayRevenue">Loading...</p>
            </div>
            <div style="padding: 20px; background: #f0f0f0; border-radius: 10px; flex: 1;">
                <h3>10% Growth Target</h3>
                <p id="growthTarget">Loading...</p>
            </div>
        </div>

        <!-- Charts -->
        <canvas id="dailyChart"></canvas>
        <canvas id="monthlyChart"></canvas>
    </div>

    <script>
        // Fetch data from PHP
        fetch('revenue_data.php')
            .then(res => res.json())
            .then(data => {
                // Update KPIs
                const today = data.daily[data.daily.length - 1];
                document.getElementById('todayRevenue').textContent = `$${today.revenue.toFixed(2)} (Target: $${today.target_10perc.toFixed(2)})`;
                
                // Render charts
                renderChart('dailyChart', 'Daily Revenue (Last 30 Days)', data.daily);
                renderChart('monthlyChart', 'Monthly Revenue (Last 12 Months)', data.monthly);
            });

        // Chart rendering function
        function renderChart(canvasId, title, data) {
            const ctx = document.getElementById(canvasId).getContext('2d');
            const labels = data.map(item => canvasId.includes('daily') ? item.date : item.month);
            
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Actual Revenue',
                            data: data.map(item => item.revenue),
                            borderColor: '#4e73df',
                            backgroundColor: 'rgba(78, 115, 223, 0.05)',
                            tension: 0.3
                        },
                        {
                            label: '10% Growth Target',
                            data: data.map(item => item.target_10perc),
                            borderColor: '#1cc88a',
                            borderDash: [5, 5],
                            backgroundColor: 'transparent',
                            tension: 0.3
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: { display: true, text: title }
                    },
                    scales: {
                        y: { beginAtZero: false }
                    }
                }
            });
        }
    </script>
</body>
</html>