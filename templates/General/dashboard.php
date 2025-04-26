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
                <h4 class="fw-medium mb-0">1$ = <?= GeneralController::getLatestExchangeRates() ?></h4>
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
                        <th class="text-right">Sales</th>
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

<div class="card custom-card">
    <div class="card-header justify-content-between">
        <div class="card-title">
            Low Stock Items (Below Minimum)
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Product</th>
                <th>Location</th>
                <th>Current</th>
                <th>Min</th>
                <th>Deficit</th>
                <th>% of Min</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($lowStock as $item): ?>
                <?php
                    $stockLevel = $this->Number->format($item->stock - $item->stock_min);
                ?>
                <tr>
                    <td><?= h($item->product->name) ?></td>
                    <td><?= h($item->room->shop->name) ?> / <?= h($item->room->name) ?></td>
                    <td><?= $this->Number->format($item->stock) ?></td>
                    <td><?= $this->Number->format($item->stock_min) ?></td>
                    <td class="<?= $stockLevel > 0 ? 'text-warning' : 'text-danger' ?>"><?= $stockLevel ?></td>
                    <td>
                        <div class="progress">
                            <div class="progress-bar <?= $stockLevel > 0 ? 'bg-warning' : 'bg-danger' ?>"
                                 role="progressbar"
                                 style="width: <?= ($item->stock / ($item->stock_min + ($item->stock_min*0.5))) * 100 ?>%"
                                 aria-valuenow="<?= ($item->stock / ($item->stock_min + ($item->stock_min*0.5))) * 100 ?>"
                                 aria-valuemin="0"
                                 aria-valuemax="100">
                                <?= round(($item->stock / ($item->stock_min + ($item->stock_min*0.5))) * 100) ?>%
                            </div>
                        </div>
                    </td>
                    <td>
                        <?= $this->Html->link('Order',
                            ['controller' => 'Purchases', 'action' => 'add', '?' => ['product_id' => $item->product_id]],
                            ['class' => 'btn btn-sm btn-primary']
                        ) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!--------------------------------------------------------------------------------------------------------->
<!-- templates/Dashboard/index.php -->
<div class="dashboard-container">
    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Monthly Sales</h5>
                    <h2 class="card-text"><?= $this->Number->currency($currentMonthSales) ?></h2>
                    <p class="text-<?= $salesGrowth >= 0 ? 'success' : 'danger' ?>">
                        <?= $this->Number->toPercentage(abs($salesGrowth), 2) ?>
                        <?= $salesGrowth >= 0 ? '↑' : '↓' ?> vs last month
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Low Stock Items</h5>
                    <h2 class="card-text"><?= count($lowStockItems) ?></h2>
                    <p class="text-muted">Items below minimum stock</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Avg. Attendance</h5>
                    <h2 class="card-text">
                        <?php
                        $avgAttendance = count($attendanceStats) > 0 ?
                            array_sum(array_map(fn($a) => ($a->present_days / $a->total_days) * 100, $attendanceStats)) / count($attendanceStats) :
                            0;
                        echo $this->Number->toPercentage($avgAttendance, 1);
                        ?>
                    </h2>
                    <p class="text-muted">Current month</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Sales Trend (Last 6 Months)</h5>
                    <canvas id="salesTrendChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Top Products by Revenue</h5>
                    <canvas id="topProductsChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Second Charts Row -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Expense Breakdown</h5>
                    <canvas id="expenseChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Attendance Overview</h5>
                    <canvas id="attendanceChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Tables -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Low Stock Alerts</h5>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Current Stock</th>
                                <th>Min Stock</th>
                                <th>Deficit</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($lowStockItems as $item): ?>
                                <tr>
                                    <td><?= h($item->product->name) ?></td>
                                    <td><?= h($item->stock) ?></td>
                                    <td><?= h($item->stock_min) ?></td>
                                    <td class="text-danger"><?= h($item->stock_min - $item->stock) ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Top Performers</h5>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Units Sold</th>
                                <th>Revenue</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($topProducts as $product): ?>
                                <tr>
                                    <td><?= h($product->name) ?></td>
                                    <td><?= h($product->total_sold) ?></td>
                                    <td><?= $this->Number->currency($product->total_revenue) ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--------------------------------------------------------------------------------------------------------->

<div class="dashboard-summary">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Sales</h5>
                    <h2 class="card-value" id="totalSales"><?= $summary->total_sales ?? 0 ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Revenue</h5>
                    <h2 class="card-value" id="totalRevenue"><?= $this->Number->currency($summary->total_revenue ?? 0) ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Customers</h5>
                    <h2 class="card-value" id="totalCustomers"><?= $summary->total_customers ?? 0 ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Avg Sale Value</h5>
                    <h2 class="card-value" id="avgOrderValue"><?= $this->Number->currency($summary->avg_order_value ?? 0) ?></h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="dashboard-charts mt-4">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Sales Trend</h5>
                    <canvas id="salesTrendChart2"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Top Products by Revenue</h5>
                    <canvas id="topProductsChart2"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="dashboard-customer-metrics mt-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">New Customers</h5>
                    <h2 class="card-value" id="newCustomers"><?= $customerMetrics['new_customers'] ?? 0 ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Returning Customers</h5>
                    <h2 class="card-value" id="returningCustomers"><?= $customerMetrics['returning_customers'] ?? 0 ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Avg Customer Lifetime Value</h5>
                    <h2 class="card-value" id="avgClv"><?= $this->Number->currency($customerMetrics['avg_clv'] ?? 0) ?></h2>
                </div>
            </div>
        </div>
    </div>
</div>

<!--------------------------------------------------------------------------------------------------------->

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

<script>
    $(document).ready(function() {
        // Stock History Chart
        const ctx = document.getElementById('stockHistoryChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?= json_encode($stockHistory->extract('modified')->map(function($date) {
                    return $date->format('Y-m-d');
                })->toList()) ?>,
                datasets: [{
                    label: 'Stock Level',
                    data: <?= json_encode($stockHistory->extract('stock')->toList()) ?>,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1,
                    fill: false
                }, {
                    label: 'Minimum Stock',
                    data: <?= json_encode($stockHistory->extract('stock_min')->toList()) ?>,
                    borderColor: 'rgb(255, 99, 132)',
                    borderDash: [5, 5],
                    tension: 0.1,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>

<!-------------------------------------------------------------------------------------->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sales Trend Chart
        const salesTrendCtx = document.getElementById('salesTrendChart').getContext('2d');
        new Chart(salesTrendCtx, {
            type: 'line',
            data: {
                labels: <?= json_encode(array_column($salesTrend, 'month')) ?>,
                datasets: [{
                    label: 'Sales',
                    data: <?= json_encode(array_column($salesTrend, 'total_sales')) ?>,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.1)',
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Sales: ' + new Intl.NumberFormat('en-US', {
                                    style: 'currency',
                                    currency: 'USD'
                                }).format(context.raw);
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        ticks: {
                            callback: function(value) {
                                return new Intl.NumberFormat('en-US', {
                                    style: 'currency',
                                    currency: 'USD',
                                    maximumFractionDigits: 0
                                }).format(value);
                            }
                        }
                    }
                }
            }
        });

        // Top Products Chart
        const topProductsCtx = document.getElementById('topProductsChart').getContext('2d');
        new Chart(topProductsCtx, {
            type: 'bar',
            data: {
                labels: <?= json_encode(array_column($topProducts, 'name')) ?>,
                datasets: [{
                    label: 'Revenue',
                    data: <?= json_encode(array_column($topProducts, 'total_revenue')) ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Revenue: ' + new Intl.NumberFormat('en-US', {
                                    style: 'currency',
                                    currency: 'USD'
                                }).format(context.raw);
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        ticks: {
                            callback: function(value) {
                                return new Intl.NumberFormat('en-US', {
                                    style: 'currency',
                                    currency: 'USD',
                                    maximumFractionDigits: 0
                                }).format(value);
                            }
                        }
                    }
                }
            }
        });

        // Expense Breakdown Chart
        const expenseCtx = document.getElementById('expenseChart').getContext('2d');
        new Chart(expenseCtx, {
            type: 'doughnut',
            data: {
                labels: <?= json_encode(array_column($expenseCategories, 'name')) ?>,
                datasets: [{
                    data: <?= json_encode(array_column($expenseCategories, 'total_amount')) ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + new Intl.NumberFormat('en-US', {
                                    style: 'currency',
                                    currency: 'CDF'
                                }).format(context.raw);
                            }
                        }
                    }
                }
            }
        });

        // Attendance Chart
        const attendanceCtx = document.getElementById('attendanceChart').getContext('2d');
        new Chart(attendanceCtx, {
            type: 'radar',
            data: {
                labels: <?= json_encode(array_map(fn($a) => $a->affectation->user->firstname, $attendanceStats)) ?>,
                datasets: [{
                    label: 'Attendance Rate',
                    data: <?= json_encode(array_map(fn($a) => ($a->present_days / $a->total_days) * 100, $attendanceStats)) ?>,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    pointBackgroundColor: 'rgba(153, 102, 255, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(153, 102, 255, 1)'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    r: {
                        angleLines: {
                            display: true
                        },
                        suggestedMin: 0,
                        suggestedMax: 100,
                        ticks: {
                            callback: function(value) {
                                return value + '%';
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.raw.toFixed(1) + '%';
                            }
                        }
                    }
                }
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Initialize charts
        const salesTrendCtx = document.getElementById('salesTrendChart2').getContext('2d');
        const topProductsCtx = document.getElementById('topProductsChart2').getContext('2d');

        let salesTrendChart2 = new Chart(salesTrendCtx, {
            type: 'line',
            data: {
                labels: <?= json_encode(array_column($trend, 'period')) ?>,
                datasets: [{
                    label: 'Revenue',
                    data: <?= json_encode(array_column($trend, 'total_revenue')) ?>,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1,
                    yAxisID: 'y'
                }, {
                    label: 'Sales',
                    data: <?= json_encode(array_column($trend, 'total_sales')) ?>,
                    borderColor: 'rgb(54, 162, 235)',
                    tension: 0.1,
                    yAxisID: 'y1'
                }]
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
                        title: {
                            display: true,
                            text: 'Revenue'
                        }
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        title: {
                            display: true,
                            text: 'Sales'
                        },
                        grid: {
                            drawOnChartArea: false
                        }
                    }
                }
            }
        });

        let topProductsChart = new Chart(topProductsCtx, {
            type: 'bar',
            data: {
                labels: <?= json_encode(array_column($topProducts, 'product_name')) ?>,
                datasets: [{
                    label: 'Revenue',
                    data: <?= json_encode(array_column($topProducts, 'total_revenue')) ?>,
                    backgroundColor: 'rgba(153, 102, 255, 0.6)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Revenue'
                        }
                    }
                }
            }
        });

        // Filter form submission with AJAX
        $('#dashboardFilter').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                type: 'GET',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    // Update summary cards
                    $('#totalSales').text(response.summary.total_sales);
                    $('#totalRevenue').text('$' + parseFloat(response.summary.total_revenue).toFixed(2));
                    $('#totalCustomers').text(response.summary.total_customers);
                    $('#avgOrderValue').text('$' + parseFloat(response.summary.avg_order_value).toFixed(2));

                    // Update customer metrics
                    $('#newCustomers').text(response.customerMetrics.new_customers);
                    $('#returningCustomers').text(response.customerMetrics.returning_customers);
                    $('#avgClv').text('$' + parseFloat(response.customerMetrics.avg_clv).toFixed(2));

                    // Update charts
                    salesTrendChart2.data.labels = response.trend.map(item => item.period);
                    salesTrendChart2.data.datasets[0].data = response.trend.map(item => item.total_revenue);
                    salesTrendChart2.data.datasets[1].data = response.trend.map(item => item.total_sales);
                    salesTrendChart2.update();

                    topProductsChart2.data.labels = response.topProducts.map(item => item.product_name);
                    topProductsChart2.data.datasets[0].data = response.topProducts.map(item => item.total_revenue);
                    topProductsChart2.update();
                }
            });
        });
    });
</script>
