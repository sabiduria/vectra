<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Sales Analytics Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom@1.2.1"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment@1.0.0/dist/chartjs-adapter-moment.min.js"></script>
    <style>
        .chart-container {
            position: relative;
            height: 400px;
            margin-bottom: 30px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 20px;
        }
        .chart-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #333;
        }
        .metric-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .metric-value {
            font-size: 28px;
            font-weight: 700;
            color: #2c3e50;
        }
        .metric-label {
            font-size: 14px;
            color: #7f8c8d;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .positive {
            color: #27ae60;
        }
        .negative {
            color: #e74c3c;
        }
        .filter-section {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <h1 class="mb-4">Advanced Sales Analytics Dashboard</h1>
        
        <!-- Filters -->
        <div class="filter-section mb-4">
            <div class="row">
                <div class="col-md-3">
                    <label class="form-label">Time Frame</label>
                    <select id="timeframe" class="form-select">
                        <option value="daily">Daily</option>
                        <option value="weekly">Weekly</option>
                        <option value="monthly" selected>Monthly</option>
                        <option value="yearly">Yearly</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Start Date</label>
                    <input type="date" id="start_date" class="form-control">
                </div>
                <div class="col-md-3">
                    <label class="form-label">End Date</label>
                    <input type="date" id="end_date" class="form-control">
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button id="apply-filters" class="btn btn-primary w-100">Apply Filters</button>
                </div>
            </div>
        </div>
        
        <!-- Summary Metrics -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="metric-card">
                    <div class="metric-label">Total Sales</div>
                    <div class="metric-value" id="total-sales">$0</div>
                    <div class="metric-change" id="total-sales-change">0% vs previous period</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="metric-card">
                    <div class="metric-label">Transactions</div>
                    <div class="metric-value" id="total-transactions">0</div>
                    <div class="metric-change" id="transactions-change">0% vs previous period</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="metric-card">
                    <div class="metric-label">Avg. Transaction</div>
                    <div class="metric-value" id="avg-transaction">$0</div>
                    <div class="metric-change" id="avg-transaction-change">0% vs previous period</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="metric-card">
                    <div class="metric-label">Top Product</div>
                    <div class="metric-value" id="top-product">-</div>
                    <div class="metric-change" id="top-product-contribution">0% of sales</div>
                </div>
            </div>
        </div>
        
        <!-- Main Charts -->
        <div class="row">
            <div class="col-md-8">
                <div class="chart-container">
                    <div class="chart-title">Sales Trend with Transaction Volume</div>
                    <canvas id="salesTrendChart"></canvas>
                </div>
            </div>
            <div class="col-md-4">
                <div class="chart-container">
                    <div class="chart-title">Top Products by Revenue</div>
                    <canvas id="topProductsChart"></canvas>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="chart-container">
                    <div class="chart-title">Sales by Shop</div>
                    <canvas id="salesByShopChart"></canvas>
                </div>
            </div>
            <div class="col-md-6">
                <div class="chart-container">
                    <div class="chart-title">Sales Composition</div>
                    <canvas id="salesCompositionChart"></canvas>
                </div>
            </div>
        </div>
        
        <!-- Data Table -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="chart-container">
                    <div class="chart-title">Detailed Sales Data</div>
                    <div class="table-responsive">
                        <table id="salesTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Period</th>
                                    <th>Total Sales</th>
                                    <th>Transactions</th>
                                    <th>Avg. Transaction</th>
                                    <th>Shop</th>
                                    <th>Area</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data will be populated by JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Global variables to store chart instances
        let salesTrendChart, topProductsChart, salesByShopChart, salesCompositionChart;
        
        // Initialize dashboard
        document.addEventListener('DOMContentLoaded', function() {
            // Set default date range (last 12 months)
            const endDate = new Date();
            const startDate = new Date();
            startDate.setMonth(endDate.getMonth() - 12);
            
            document.getElementById('start_date').valueAsDate = startDate;
            document.getElementById('end_date').valueAsDate = endDate;
            
            // Load initial data
            fetchSalesData();
            
            // Add event listener for filter button
            document.getElementById('apply-filters').addEventListener('click', fetchSalesData);
        });
        
        // Fetch sales data from server
        function fetchSalesData() {
            const timeframe = document.getElementById('timeframe').value;
            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;
            
            // Show loading state
            document.querySelectorAll('.chart-container canvas').forEach(canvas => {
                canvas.style.display = 'none';
                const loadingDiv = document.createElement('div');
                loadingDiv.className = 'text-center py-5';
                loadingDiv.innerHTML = '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>';
                canvas.parentNode.insertBefore(loadingDiv, canvas.nextSibling);
            });
            
            // Build query parameters
            let params = `timeframe=${timeframe}`;
            if (startDate) params += `&start_date=${startDate}`;
            if (endDate) params += `&end_date=${endDate}`;
            
            fetch(`sales_data.php?${params}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        processSalesData(data.data);
                    } else {
                        alert('Error loading data: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to load data');
                })
                .finally(() => {
                    // Hide loading indicators and show charts
                    document.querySelectorAll('.chart-container canvas').forEach(canvas => {
                        canvas.style.display = 'block';
                        const loadingDiv = canvas.previousElementSibling;
                        if (loadingDiv && loadingDiv.className.includes('text-center')) {
                            loadingDiv.remove();
                        }
                    });
                });
        }
        
        // Process and display sales data
        function processSalesData(data) {
            // Update summary metrics
            updateSummaryMetrics(data);
            
            // Update charts
            updateSalesTrendChart(data.time_series);
            updateTopProductsChart(data.product_performance);
            updateSalesByShopChart(data.shop_performance);
            updateSalesCompositionChart(data.shop_performance);
            
            // Update data table
            updateSalesTable(data.sales_data);
        }
        
        // Update summary metrics
        function updateSummaryMetrics(data) {
            // Calculate totals
            const totalSales = data.time_series.reduce((sum, item) => sum + item.total_sales, 0);
            const totalTransactions = data.time_series.reduce((sum, item) => sum + item.transaction_count, 0);
            const avgTransaction = totalTransactions > 0 ? totalSales / totalTransactions : 0;
            
            // Find top product
            let topProduct = '-';
            let topProductSales = 0;
            if (Object.keys(data.product_performance).length > 0) {
                topProduct = Object.keys(data.product_performance)[0];
                topProductSales = data.product_performance[topProduct];
            }
            
            // Update DOM
            document.getElementById('total-sales').textContent = formatCurrency(totalSales);
            document.getElementById('total-transactions').textContent = totalTransactions.toLocaleString();
            document.getElementById('avg-transaction').textContent = formatCurrency(avgTransaction);
            document.getElementById('top-product').textContent = topProduct;
            
            // Calculate changes (simplified - in a real app you'd compare with previous period)
            const salesChange = 7.5; // This would be calculated from data
            const transactionsChange = 3.2;
            const avgTransactionChange = 4.1;
            const topProductContribution = totalSales > 0 ? (topProductSales / totalSales * 100) : 0;
            
            document.getElementById('total-sales-change').textContent = `${salesChange >= 0 ? '+' : ''}${salesChange.toFixed(1)}% vs previous period`;
            document.getElementById('total-sales-change').className = `metric-change ${salesChange >= 0 ? 'positive' : 'negative'}`;
            
            document.getElementById('transactions-change').textContent = `${transactionsChange >= 0 ? '+' : ''}${transactionsChange.toFixed(1)}% vs previous period`;
            document.getElementById('transactions-change').className = `metric-change ${transactionsChange >= 0 ? 'positive' : 'negative'}`;
            
            document.getElementById('avg-transaction-change').textContent = `${avgTransactionChange >= 0 ? '+' : ''}${avgTransactionChange.toFixed(1)}% vs previous period`;
            document.getElementById('avg-transaction-change').className = `metric-change ${avgTransactionChange >= 0 ? 'positive' : 'negative'}`;
            
            document.getElementById('top-product-contribution').textContent = `${topProductContribution.toFixed(1)}% of sales`;
        }
        
        // Update sales trend chart
        function updateSalesTrendChart(timeSeriesData) {
            const ctx = document.getElementById('salesTrendChart').getContext('2d');
            
            // Prepare data
            const labels = timeSeriesData.map(item => item.date_label);
            const salesData = timeSeriesData.map(item => item.total_sales);
            const transactionData = timeSeriesData.map(item => item.transaction_count);
            
            // Destroy previous chart if it exists
            if (salesTrendChart) {
                salesTrendChart.destroy();
            }
            
            // Create new chart
            salesTrendChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Total Sales',
                            data: salesData,
                            borderColor: 'rgba(54, 162, 235, 1)',
                            backgroundColor: 'rgba(54, 162, 235, 0.1)',
                            borderWidth: 2,
                            yAxisID: 'y',
                            fill: true
                        },
                        {
                            label: 'Transaction Count',
                            data: transactionData,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.1)',
                            borderWidth: 2,
                            yAxisID: 'y1',
                            fill: false
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.datasetIndex === 0) {
                                        label += formatCurrency(context.raw);
                                    } else {
                                        label += context.raw.toLocaleString();
                                    }
                                    return label;
                                }
                            }
                        },
                        zoom: {
                            zoom: {
                                wheel: {
                                    enabled: true,
                                },
                                pinch: {
                                    enabled: true
                                },
                                mode: 'xy',
                            },
                            pan: {
                                enabled: true,
                                mode: 'xy',
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            type: 'linear',
                            display: true,
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Sales Amount'
                            },
                            ticks: {
                                callback: function(value) {
                                    return formatCurrency(value, true);
                                }
                            }
                        },
                        y1: {
                            type: 'linear',
                            display: true,
                            position: 'right',
                            title: {
                                display: true,
                                text: 'Transaction Count'
                            },
                            grid: {
                                drawOnChartArea: false,
                            }
                        }
                    },
                    interaction: {
                        mode: 'nearest',
                        axis: 'x',
                        intersect: false
                    }
                }
            });
        }
        
        // Update top products chart
        function updateTopProductsChart(productPerformance) {
            const ctx = document.getElementById('topProductsChart').getContext('2d');
            
            // Prepare data
            const products = Object.keys(productPerformance);
            const sales = Object.values(productPerformance);
            
            // Destroy previous chart if it exists
            if (topProductsChart) {
                topProductsChart.destroy();
            }
            
            // Create new chart
            topProductsChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: products,
                    datasets: [{
                        label: 'Sales Revenue',
                        data: sales,
                        backgroundColor: 'rgba(52, 152, 219, 0.7)',
                        borderColor: 'rgba(52, 152, 219, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return formatCurrency(context.raw);
                                }
                            }
                        },
                        datalabels: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return formatCurrency(value, true);
                                }
                            }
                        }
                    },
                    indexAxis: 'y'
                },
                plugins: [ChartDataLabels]
            });
        }
        
        // Update sales by shop chart
        function updateSalesByShopChart(shopPerformance) {
            const ctx = document.getElementById('salesByShopChart').getContext('2d');
            
            // Prepare data
            const shops = shopPerformance.map(shop => shop.shop_name);
            const sales = shopPerformance.map(shop => shop.total_sales);
            const transactions = shopPerformance.map(shop => shop.transaction_count);
            
            // Destroy previous chart if it exists
            if (salesByShopChart) {
                salesByShopChart.destroy();
            }
            
            // Create new chart
            salesByShopChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: shops,
                    datasets: [
                        {
                            label: 'Total Sales',
                            data: sales,
                            backgroundColor: 'rgba(155, 89, 182, 0.7)',
                            borderColor: 'rgba(155, 89, 182, 1)',
                            borderWidth: 1,
                            yAxisID: 'y'
                        },
                        {
                            label: 'Avg. Transaction',
                            data: shopPerformance.map(shop => shop.total_sales / shop.transaction_count),
                            backgroundColor: 'rgba(46, 204, 113, 0.7)',
                            borderColor: 'rgba(46, 204, 113, 1)',
                            borderWidth: 1,
                            type: 'line',
                            yAxisID: 'y1'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.datasetIndex === 0) {
                                        label += formatCurrency(context.raw);
                                    } else {
                                        label += formatCurrency(context.raw);
                                    const shop = shopPerformance[context.dataIndex];
                                        label += ` (${shop.transaction_count} transactions)`;
                                    }
                                    return label;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            type: 'linear',
                            display: true,
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Total Sales'
                            },
                            ticks: {
                                callback: function(value) {
                                    return formatCurrency(value, true);
                                }
                            }
                        },
                        y1: {
                            type: 'linear',
                            display: true,
                            position: 'right',
                            title: {
                                display: true,
                                text: 'Avg. Transaction'
                            },
                            grid: {
                                drawOnChartArea: false,
                            },
                            ticks: {
                                callback: function(value) {
                                    return formatCurrency(value, true);
                                }
                            }
                        }
                    }
                }
            });
        }
        
        // Update sales composition chart
        function updateSalesCompositionChart(shopPerformance) {
            const ctx = document.getElementById('salesCompositionChart').getContext('2d');
            
            // Group by area
            const areaSales = {};
            shopPerformance.forEach(shop => {
                if (!areaSales[shop.area_name]) {
                    areaSales[shop.area_name] = 0;
                }
                areaSales[shop.area_name] += shop.total_sales;
            });
            
            const areas = Object.keys(areaSales);
            const sales = Object.values(areaSales);
            
            // Color palette
            const backgroundColors = [
                'rgba(255, 99, 132, 0.7)',
                'rgba(54, 162, 235, 0.7)',
                'rgba(255, 206, 86, 0.7)',
                'rgba(75, 192, 192, 0.7)',
                'rgba(153, 102, 255, 0.7)',
                'rgba(255, 159, 64, 0.7)'
            ];
            
            // Destroy previous chart if it exists
            if (salesCompositionChart) {
                salesCompositionChart.destroy();
            }
            
            // Create new chart
            salesCompositionChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: areas,
                    datasets: [{
                        data: sales,
                        backgroundColor: backgroundColors,
                        borderColor: backgroundColors.map(color => color.replace('0.7', '1')),
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
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.raw;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = Math.round((value / total) * 100);
                                    return `${label}: ${formatCurrency(value)} (${percentage}%)`;
                                }
                            }
                        }
                    },
                    cutout: '70%'
                }
            });
        }
        
        // Update sales table
        function updateSalesTable(salesData) {
            const tbody = document.querySelector('#salesTable tbody');
            tbody.innerHTML = '';
            
            salesData.forEach(item => {
                const tr = document.createElement('tr');
                const avgTransaction = item.transaction_count > 0 ? item.total_sales / item.transaction_count : 0;
                
                tr.innerHTML = `
                    <td>${item.date_label}</td>
                    <td>${formatCurrency(item.total_sales)}</td>
                    <td>${item.transaction_count}</td>
                    <td>${formatCurrency(avgTransaction)}</td>
                    <td>${item.shop_name || '-'}</td>
                    <td>${item.area_name || '-'}</td>
                `;
                
                tbody.appendChild(tr);
            });
        }
        
        // Helper function to format currency
        function formatCurrency(value, short = false) {
            if (isNaN(value)) return '$0';
            
            if (short) {
                if (value >= 1000000) {
                    return '$' + (value / 1000000).toFixed(1) + 'M';
                } else if (value >= 1000) {
                    return '$' + (value / 1000).toFixed(1) + 'K';
                }
            }
            
            return '$' + value.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        }
    </script>
</body>
</html>