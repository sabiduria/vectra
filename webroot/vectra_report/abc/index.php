<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced ABC Analysis Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/luxon@3.0.1"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-luxon@1.1.0"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .class-A { background-color: #ff6b6b; color: white; }
        .class-B { background-color: #ffd166; color: #333; }
        .class-C { background-color: #06d6a0; color: white; }
        .table-responsive { max-height: 500px; overflow-y: auto; }
        .chart-container { position: relative; height: 300px; }
        .badge-A { background-color: #ff6b6b; }
        .badge-B { background-color: #ffd166; color: #333; }
        .badge-C { background-color: #06d6a0; }
    </style>
</head>
<body>
    <div class="container-fluid mt-4">
        <h1 class="mb-4">Advanced ABC Inventory Analysis</h1>
        
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Analysis Controls</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="timeRange" class="form-label">Time Range:</label>
                                <select id="timeRange" class="form-select">
                                    <option value="1 MONTH">Last 1 Month</option>
                                    <option value="3 MONTH" selected>Last 3 Months</option>
                                    <option value="6 MONTH">Last 6 Months</option>
                                    <option value="1 YEAR">Last 1 Year</option>
                                </select>
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <button id="refreshBtn" class="btn btn-primary">Refresh Analysis</button>
                            </div>
                        </div>
                        <div class="row">
                            <br>
                            A Items: Top 20% of items contributing to 80% of value <br>
                            B Items: Next 30% contributing to 15% of value <br>
                            C Items: Remaining 50% contributing to 5% of value
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <!-- Summary Cards -->
            <div class="col-md-4">
                <div class="card class-A">
                    <div class="card-body">
                        <h5 class="card-title">Class A Items (High-Value Items)</h5>
                        <div class="d-flex justify-content-between">
                            <div>
                                <h2 id="classACount" class="card-text">0</h2>
                                <p class="card-text">Items</p>
                            </div>
                            <div>
                                <h2 id="classAValue" class="card-text">0%</h2>
                                <p class="card-text">of Total Value</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card class-B">
                    <div class="card-body">
                        <h5 class="card-title">Class B Items (Medium-Value Items)</h5>
                        <div class="d-flex justify-content-between">
                            <div>
                                <h2 id="classBCount" class="card-text">0</h2>
                                <p class="card-text">Items</p>
                            </div>
                            <div>
                                <h2 id="classBValue" class="card-text">0%</h2>
                                <p class="card-text">of Total Value</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card class-C">
                    <div class="card-body">
                        <h5 class="card-title">Class C Items (Low-Value Items)</h5>
                        <div class="d-flex justify-content-between">
                            <div>
                                <h2 id="classCCount" class="card-text">0</h2>
                                <p class="card-text">Items</p>
                            </div>
                            <div>
                                <h2 id="classCValue" class="card-text">0%</h2>
                                <p class="card-text">of Total Value</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-4">
            <!-- Pareto Chart -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Pareto Analysis (Value Concentration)</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="paretoChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- ABC Distribution Pie Chart -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>ABC Class Distribution</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="abcPieChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-4">
            <!-- Detailed Data Table -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Inventory Items by ABC Classification</h5>
                        <div>
                            <button id="exportBtn" class="btn btn-sm btn-success">Export to CSV</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Class</th>
                                        <th>Product ID</th>
                                        <th>Reference</th>
                                        <th>Product Name</th>
                                        <th>Quantity Sold</th>
                                        <th>Total Value</th>
                                        <th>% of Total</th>
                                        <th>Cumulative %</th>
                                        <th>Orders</th>
                                        <th>Turnover Rate</th>
                                    </tr>
                                </thead>
                                <tbody id="abcTableBody">
                                    <!-- Data will be populated here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-4">
            <!-- Advanced Metrics -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Advanced ABC Metrics</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="advancedMetricsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Turnover Analysis -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Turnover Rate by ABC Class</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="turnoverChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Global variables
        let abcData = [];
        let abcCharts = {
            pareto: null,
            pie: null,
            advanced: null,
            turnover: null
        };
        
        // DOM Ready
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize charts
            initCharts();
            
            // Load initial data
            loadABCData();
            
            // Event listeners
            document.getElementById('refreshBtn').addEventListener('click', loadABCData);
            document.getElementById('exportBtn').addEventListener('click', exportToCSV);
        });
        
        function initCharts() {
            // Pareto Chart
            const paretoCtx = document.getElementById('paretoChart').getContext('2d');
            abcCharts.pareto = new Chart(paretoCtx, {
                type: 'bar',
                data: {
                    labels: [],
                    datasets: [
                        {
                            label: 'Cumulative Value %',
                            type: 'line',
                            data: [],
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderWidth: 2,
                            fill: false,
                            yAxisID: 'y1'
                        },
                        {
                            label: 'Individual Value %',
                            data: [],
                            backgroundColor: 'rgba(54, 162, 235, 0.7)',
                            yAxisID: 'y'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            type: 'linear',
                            display: true,
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Individual Value %'
                            },
                            max: 100
                        },
                        y1: {
                            type: 'linear',
                            display: true,
                            position: 'right',
                            title: {
                                display: true,
                                text: 'Cumulative Value %'
                            },
                            grid: {
                                drawOnChartArea: false
                            },
                            max: 100
                        },
                        x: {
                            ticks: {
                                callback: function(value, index, values) {
                                    return index % 5 === 0 ? this.getLabelForValue(value) : '';
                                }
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += context.parsed.y.toFixed(2) + '%';
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
            
            // ABC Pie Chart
            const pieCtx = document.getElementById('abcPieChart').getContext('2d');
            abcCharts.pie = new Chart(pieCtx, {
                type: 'pie',
                data: {
                    labels: ['Class A', 'Class B', 'Class C'],
                    datasets: [{
                        data: [0, 0, 0],
                        backgroundColor: [
                            '#ff6b6b',
                            '#ffd166',
                            '#06d6a0'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                        },
                        datalabels: {
                            formatter: (value, ctx) => {
                                let sum = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                                let percentage = (value * 100 / sum).toFixed(1) + '%';
                                return percentage;
                            },
                            color: '#fff',
                            font: {
                                weight: 'bold'
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = Math.round((value / total) * 100);
                                    return `${label}: ${value} (${percentage}%)`;
                                }
                            }
                        }
                    }
                },
                plugins: [ChartDataLabels]
            });
            
            // Advanced Metrics Chart
            const advancedCtx = document.getElementById('advancedMetricsChart').getContext('2d');
            abcCharts.advanced = new Chart(advancedCtx, {
                type: 'bar',
                data: {
                    labels: ['Class A', 'Class B', 'Class C'],
                    datasets: [
                        {
                            label: '% of Items',
                            data: [0, 0, 0],
                            backgroundColor: 'rgba(54, 162, 235, 0.7)',
                            yAxisID: 'y'
                        },
                        {
                            label: '% of Value',
                            data: [0, 0, 0],
                            backgroundColor: 'rgba(255, 99, 132, 0.7)',
                            yAxisID: 'y'
                        },
                        {
                            label: '% of Quantity',
                            data: [0, 0, 0],
                            backgroundColor: 'rgba(75, 192, 192, 0.7)',
                            yAxisID: 'y'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            title: {
                                display: true,
                                text: 'Percentage (%)'
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `${context.dataset.label}: ${context.raw.toFixed(1)}%`;
                                }
                            }
                        }
                    }
                }
            });
            
            // Turnover Rate Chart
            const turnoverCtx = document.getElementById('turnoverChart').getContext('2d');
            abcCharts.turnover = new Chart(turnoverCtx, {
                type: 'bar',
                data: {
                    labels: ['Class A', 'Class B', 'Class C'],
                    datasets: [{
                        label: 'Average Turnover Rate (Value per Unit)',
                        data: [0, 0, 0],
                        backgroundColor: [
                            'rgba(255, 107, 107, 0.7)',
                            'rgba(255, 209, 102, 0.7)',
                            'rgba(6, 214, 160, 0.7)'
                        ],
                        borderColor: [
                            'rgba(255, 107, 107, 1)',
                            'rgba(255, 209, 102, 1)',
                            'rgba(6, 214, 160, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Turnover Rate'
                            }
                        }
                    }
                }
            });
        }
        
        function loadABCData() {
            const timeRange = document.getElementById('timeRange').value;
            const loadingIndicator = '<tr><td colspan="10" class="text-center">Loading data...</td></tr>';
            document.getElementById('abcTableBody').innerHTML = loadingIndicator;
            
            fetch(`abc_analysis.php?time_range=${encodeURIComponent(timeRange)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        abcData = data.data;
                        updateDashboard(data);
                    } else {
                        alert(data.error || 'Error loading ABC analysis data');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to load ABC analysis data');
                });
        }
        
        function updateDashboard(data) {
            // Update summary cards
            document.getElementById('classACount').textContent = data.summary.class_counts.A;
            document.getElementById('classBCount').textContent = data.summary.class_counts.B;
            document.getElementById('classCCount').textContent = data.summary.class_counts.C;
            
            document.getElementById('classAValue').textContent = data.summary.value_distribution.A + '%';
            document.getElementById('classBValue').textContent = data.summary.value_distribution.B + '%';
            document.getElementById('classCValue').textContent = data.summary.value_distribution.C + '%';
            
            // Update Pareto chart
            const productLabels = data.data.map(item => item.product_name);
            const individualValues = data.data.map(item => item.percentage_of_total);
            const cumulativeValues = data.data.map(item => item.cumulative_percentage);
            
            abcCharts.pareto.data.labels = productLabels;
            abcCharts.pareto.data.datasets[0].data = cumulativeValues;
            abcCharts.pareto.data.datasets[1].data = individualValues;
            abcCharts.pareto.update();
            
            // Update ABC Pie chart
            abcCharts.pie.data.datasets[0].data = [
                data.summary.value_distribution.A,
                data.summary.value_distribution.B,
                data.summary.value_distribution.C
            ];
            abcCharts.pie.update();
            
            // Update Advanced Metrics chart
            abcCharts.advanced.data.datasets[0].data = [
                data.summary.class_percentages.A,
                data.summary.class_percentages.B,
                data.summary.class_percentages.C
            ];
            abcCharts.advanced.data.datasets[1].data = [
                data.summary.value_distribution.A,
                data.summary.value_distribution.B,
                data.summary.value_distribution.C
            ];
            abcCharts.advanced.data.datasets[2].data = [
                data.summary.quantity_distribution.A,
                data.summary.quantity_distribution.B,
                data.summary.quantity_distribution.C
            ];
            abcCharts.advanced.update();
            
            // Update Turnover Rate chart
            abcCharts.turnover.data.datasets[0].data = [
                data.summary.average_turnover.A,
                data.summary.average_turnover.B,
                data.summary.average_turnover.C
            ];
            abcCharts.turnover.update();
            
            // Update table
            updateTable(data.data);
        }
        
        function updateTable(items) {
            const tableBody = document.getElementById('abcTableBody');
            tableBody.innerHTML = '';
            
            items.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td><span class="badge badge-${item.class}">${item.class}</span></td>
                    <td>${item.product_id}</td>
                    <td>${item.reference}</td>
                    <td>${item.product_name}</td>
                    <td>${item.total_quantity}</td>
                    <td>${item.total_value.toFixed(2)}</td>
                    <td>${item.percentage_of_total}%</td>
                    <td>${item.cumulative_percentage}%</td>
                    <td>${item.order_count}</td>
                    <td>${item.turnover_rate.toFixed(2)}</td>
                `;
                tableBody.appendChild(row);
            });
        }
        
        function exportToCSV() {
            if (abcData.length === 0) {
                alert('No data to export');
                return;
            }
            
            // CSV header
            let csv = 'Class,Product ID,Reference,Product Name,Quantity Sold,Total Value,% of Total,Cumulative %,Orders,Turnover Rate\n';
            
            // Add data rows
            abcData.forEach(item => {
                csv += `"${item.class}",` +
                       `"${item.product_id}",` +
                       `"${item.reference}",` +
                       `"${item.product_name}",` +
                       `"${item.total_quantity}",` +
                       `"${item.total_value.toFixed(2)}",` +
                       `"${item.percentage_of_total}%",` +
                       `"${item.cumulative_percentage}%",` +
                       `"${item.order_count}",` +
                       `"${item.turnover_rate.toFixed(2)}"\n`;
            });
            
            // Create download link
            const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
            const url = URL.createObjectURL(blob);
            const link = document.createElement('a');
            link.setAttribute('href', url);
            link.setAttribute('download', `abc_analysis_${new Date().toISOString().slice(0,10)}.csv`);
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    </script>
</body>
</html>