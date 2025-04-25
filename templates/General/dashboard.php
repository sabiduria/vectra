<?php
/**
 * @var \App\View\AppView $this
 */

use App\Controller\GeneralController;

$totalSales = array_sum(array_column($salesStats, 'total_sales'));
$totalQuantity = array_sum(array_column($salesStats, 'total_quantity'));

?>

<div class="row">
    <div class="col-sm-12">
        <div class="d-sm-flex align-items-end  p-3 bg-light gap-5 flex-wrap pb-5">
            <div class="min-w-fit-content me-3">
                <p class="mb-1">Total Ventes</p>
                <h4 class="fw-medium mb-0"><?= $totalSales ?></h4>
            </div>
            <div class="min-w-fit-content">
                <p class="mb-1">Quantité Produits Vendus</p>
                <h4 class="fw-medium mb-0"><?= $totalQuantity ?></h4>
            </div>
            <div class="min-w-fit-content">
                <p class="mb-1">Catégories Actives</p>
                <h4 class="fw-medium mb-0"><?= count($salesStats) ?></h4>
            </div>
            <div class="min-w-fit-content">
                <p class="mb-1">Taux d'échanges</p>
                <h4 class="fw-medium mb-0">$124,784.23<span class="badge bg-danger ms-2 fs-9"><i class="ti ti-trending-down me-1"></i>0.12%</span></h4>
            </div>
            <div class="flex-1 text-sm-end mt-2 mt-sm-0 ms-auto">
                <a href="javascript:void(0);" class="btn btn-w-lg btn-primary1-light"><i class="ti ti-plus me-1"></i>Details</a>
            </div>
        </div>
    </div>

    <div class="col-xxl-3 col-xl-6">
        <div class="card custom-card overflow-hidden main-content-card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between mb-2 gap-1 flex-xxl-nowrap flex-wrap">
                    <div>
                        <span class="text-muted d-block mb-1 text-nowrap">Total Produits</span>
                        <h4 class="fw-medium mb-0">854</h4>
                    </div>
                    <div class="lh-1">
                        <span class="avatar avatar-md avatar-rounded bg-primary">
                            <i class="ti ti-shopping-cart fs-5"></i>
                        </span>
                    </div>
                </div>
                <div class="text-muted fs-13">Stats : <span class="text-success">2.56%<i class="ti ti-arrow-narrow-up fs-16"></i></span></div>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-xl-6">
        <div class="card custom-card overflow-hidden main-content-card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between mb-2 gap-1 flex-xxl-nowrap flex-wrap">
                    <div>
                        <span class="text-muted d-block mb-1 text-nowrap">Total Clients</span>
                        <h4 class="fw-medium mb-0">31,876</h4>
                    </div>
                    <div class="lh-1">
                        <span class="avatar avatar-md avatar-rounded bg-primary1">
                            <i class="ti ti-users fs-5"></i>
                        </span>
                    </div>
                </div>
                <div class="text-muted fs-13">Stats : <span class="text-success">0.34%<i class="ti ti-arrow-narrow-up fs-16"></i></span></div>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-xl-6">
        <div class="card custom-card overflow-hidden main-content-card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between mb-2 gap-1 flex-xxl-nowrap flex-wrap">
                    <div>
                        <span class="text-muted d-block mb-1 text-nowrap">Total Revenue</span>
                        <h4 class="fw-medium mb-0">$34,241</h4>
                    </div>
                    <div class="lh-1">
                        <span class="avatar avatar-md avatar-rounded bg-primary2">
                            <i class="ti ti-currency-dollar fs-5"></i>
                        </span>
                    </div>
                </div>
                <div class="text-muted fs-13">Stats : <span class="text-success">7.66%<i class="ti ti-arrow-narrow-up fs-16"></i></span></div>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-xl-6">
        <div class="card custom-card overflow-hidden main-content-card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between mb-2 gap-1 flex-xxl-nowrap flex-wrap">
                    <div>
                        <span class="text-muted d-block mb-1 text-nowrap">Total Factures</span>
                        <h4 class="fw-medium mb-0">1,76,586</h4>
                    </div>
                    <div class="lh-1">
                        <span class="avatar avatar-md avatar-rounded bg-primary3">
                            <i class="ti ti-chart-bar fs-5"></i>
                        </span>
                    </div>
                </div>
                <div class="text-muted fs-13">Stats : <span class="text-danger">0.74%<i class="ti ti-arrow-narrow-down fs-16"></i></span></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="card custom-card overflow-hidden">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    Profit
                </div>
            </div>
            <div class="card-body">
                <canvas id="performanceChart" height="150"></canvas>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <!-- Revenue Trend Chart -->
        <div class="card custom-card overflow-hidden">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    Revenue Trend
                </div>
            </div>
            <div class="card-body">
                <canvas id="revenueTrendChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- in templates/Categories/sales_dashboard.php -->
 <!-- Charts Section -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Ventes par catégories
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="salesDistributionChart" height="300"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Tendance Mensuelle des ventes
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="monthlyTrendChart" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Table -->
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">
                Performance de ventes par catégories
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th>Category</th>
                        <th class="text-right">Total Sales</th>
                        <th class="text-right">Quantity Sold</th>
                        <th class="text-right">Avg. Price</th>
                        <th class="text-right">Products</th>
                        <th class="text-right">Orders</th>
                        <th class="text-right">Sales/Product</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($salesStats as $category): ?>
                        <tr>
                            <td><?= h($category->name) ?></td>
                            <td class="text-right"><?= $this->Number->currency($category->total_sales) ?></td>
                            <td class="text-right"><?= $this->Number->format($category->total_quantity) ?></td>
                            <td class="text-right"><?= $this->Number->currency($category->avg_price) ?></td>
                            <td class="text-right"><?= $this->Number->format($category->product_count) ?></td>
                            <td class="text-right"><?= $this->Number->format($category->order_count) ?></td>
                            <td class="text-right">
                                <?= $category->product_count > 0 ?
                                    $this->Number->currency($category->total_sales / $category->product_count) :
                                    'N/A' ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<div class="card custom-card">
    <div class="card-header justify-content-between">
        <div class="card-title">
            Top Articles (Revenue)
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Revenue</th>
                    <th>Quantity</th>
                    <th>Growth</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($data['product_performance'] as $product): ?>
                    <tr>
                        <td><?= h($product['product_name']) ?></td>
                        <td><?= h($product['category']) ?></td>
                        <td><?= number_format($product['total_sales'], 2) ?></td>
                        <td><?= number_format($product['quantity']) ?></td>
                        <td>
                            <span class="badge <?= $product['growth'] >= 0 ? 'bg-success' : 'bg-danger' ?>">
                                <?= number_format($product['growth'], 2) ?>%
                                <i class="ti ti-<?= $product['growth'] >= 0 ? 'trending-up' : 'trending-down' ?>"></i>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $this->Html->script('https://cdn.jsdelivr.net/npm/chart.js', ['block' => true]); ?>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        // Sales Distribution Chart
        const distributionCtx = document.getElementById('salesDistributionChart').getContext('2d');
        const distributionChart = new Chart(distributionCtx, {
            type: 'doughnut',
            data: {
                labels: <?= json_encode(array_column($salesStats, 'name')) ?>,
                datasets: [{
                    data: <?= json_encode(array_column($salesStats, 'total_sales')) ?>,
                    backgroundColor: [
                        '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b',
                        '#5a5c69', '#858796', '#3a3b45', '#f8f9fc', '#d1d3e2'
                    ],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }]
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                let value = context.raw || 0;
                                let total = context.dataset.data.reduce((a, b) => a + b, 0);
                                let percentage = Math.round((value / total) * 100);
                                return `${label}: ${value.toLocaleString()} (${percentage}%)`;
                            }
                        }
                    },
                    legend: {
                        position: 'right',
                        labels: {
                            usePointStyle: true
                        }
                    }
                }
            }
        });

        // Monthly Trend Chart
        const monthlyData = <?= json_encode($monthlyTrend) ?>;
        const uniqueMonths = [...new Set(monthlyData.map(item => item.year_months))];
        const categories = [...new Set(monthlyData.map(item => item.category_name))];

        const datasets = categories.map(category => {
            const categoryData = monthlyData.filter(item => item.category_name === category);
            return {
                label: category,
                data: uniqueMonths.map(month => {
                    const found = categoryData.find(item => item.year_months === month);
                    return found ? found.monthly_sales : 0;
                }),
                fill: false
            };
        });

        const trendCtx = document.getElementById('monthlyTrendChart').getContext('2d');
        const trendChart = new Chart(trendCtx, {
            type: 'line',
            data: {
                labels: uniqueMonths,
                datasets: datasets
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '$' + value.toLocaleString();
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' +
                                    '$' + context.raw.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('performanceChart').getContext('2d');
        const metrics = <?= json_encode($metrics) ?>;

        const labels = Object.keys(metrics);
        const salesData = labels.map(label => metrics[label].sales);
        const profitData = labels.map(label => metrics[label].profit);
        const growthData = labels.map(label => metrics[label].growth);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Sales ($)',
                        data: salesData,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        yAxisID: 'y'
                    },
                    {
                        label: 'Profit ($)',
                        data: profitData,
                        backgroundColor: 'rgba(75, 192, 192, 0.7)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        yAxisID: 'y'
                    },
                    {
                        label: 'Growth Rate (%)',
                        data: growthData,
                        type: 'line',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.1)',
                        borderWidth: 2,
                        pointRadius: 4,
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                scales: {
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        title: { display: true, text: 'Sales & Profit ($)' }
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        title: { display: true, text: 'Growth Rate (%)' },
                        min: Math.min(...growthData) - 5,
                        max: Math.max(...growthData) + 5,
                        grid: { drawOnChartArea: false }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label.includes('Growth')) {
                                    return label + ': ' + context.raw.toFixed(2) + '%';
                                }
                                return label + ': $' + context.raw.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Revenue Trend Chart
        const revenueCtx = document.getElementById('revenueTrendChart').getContext('2d');
        const revenueChart = new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: <?= json_encode(array_column($data['revenue_trends']['current'], 'period')) ?>,
                datasets: [
                    {
                        label: 'Current Period',
                        data: <?= json_encode(array_column($data['revenue_trends']['current'], 'total')) ?>,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        tension: 0.1,
                        fill: true
                    },
                    {
                        label: 'Comparison Period',
                        data: <?= json_encode(array_column($data['revenue_trends']['comparison'], 'total')) ?>,
                        borderColor: 'rgba(201, 203, 207, 1)',
                        backgroundColor: 'rgba(201, 203, 207, 0.2)',
                        tension: 0.1,
                        fill: true,
                        borderDash: [5, 5]
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.parsed.y.toLocaleString('en-US', {
                                    style: 'currency',
                                    currency: 'USD'
                                });
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString('en-US', {
                                    style: 'currency',
                                    currency: 'USD'
                                });
                            }
                        }
                    }
                }
            }
        });

        // AJAX form submission for filters
        document.getElementById('dashboard-filters').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const params = new URLSearchParams(formData);

            fetch(window.location.pathname + '?' + params.toString(), {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => response.json())
                .then(data => {
                    // Update the dashboard with new data
                    // This would involve updating all the charts and tables
                    // For simplicity, we'll just reload
                    window.location.reload();
                });
        });
    });
</script>
