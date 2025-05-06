<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Purchasegroup> $purchasegroups
 */

use App\Controller\GeneralController;

$this->set('title_2', 'Bon d\'Achats');
$Number = 1;
$this->set('menu_purchases', 'active open');
?>
<div class="row">
    <!--div class="col-md-6" style="height: 400px">
        <canvas id="spendChart2"></canvas>
    </div>
    <div class="col-md-6">
        <canvas id="deliveryChart"></canvas>
    </div-->
    <div class="col-sm-12">
        <h6>Supplier Performance Report</h6>

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Supplier Name</th>
                    <th class="text-right">Total Spend</th>
                    <th class="text-right">Avg. Delivery Days</th>
                    <th class="text-right">Order Count</th>
                    <th class="text-right">Avg. Order Value</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $counter = 1;
                foreach ($supplierPerformance as $supplier):
                    $avgOrderValue = $supplier['order_count'] > 0
                        ? $supplier['total_spend'] / $supplier['order_count']
                        : 0;
                    ?>
                    <tr>
                        <td><?= $counter++ ?></td>
                        <td><?= h($supplier['supplier_name']) ?></td>
                        <td class="text-right"><?= $this->Number->currency($supplier['total_spend']) ?></td>
                        <td class="text-right"><?= $this->Number->precision($supplier['avg_delivery_days'], 1) ?></td>
                        <td class="text-right"><?= $this->Number->format($supplier['order_count']) ?></td>
                        <td class="text-right"><?= $this->Number->currency($avgOrderValue) ?></td>
                    </tr>
                <?php endforeach; ?>

                <?php if (empty($supplierPerformance)): ?>
                    <tr>
                        <td colspan="6" class="text-center">No supplier data found</td>
                    </tr>
                <?php endif; ?>
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="2">Totals/Averages</th>
                    <th class="text-right"><?= $this->Number->format(array_sum(array_column($supplierPerformance, 'total_spend'))) ?></th>
                    <th class="text-right"><?= $this->Number->precision(
                            array_sum(array_column($supplierPerformance, 'avg_delivery_days')) / count($supplierPerformance),
                            1
                        ) ?></th>
                    <th class="text-right"><?= $this->Number->format(array_sum(array_column($supplierPerformance, 'order_count'))) ?></th>
                    <th class="text-right"><?= $this->Number->currency(
                            array_sum(array_column($supplierPerformance, 'total_spend')) / array_sum(array_column($supplierPerformance, 'order_count'))
                        ) ?></th>
                </tr>
                </tfoot>
            </table>
        </div>

        <div class="text-muted">
            <small>Report generated: <?= date('Y-m-d H:i:s') ?></small>
        </div>
    </div>

    <hr>

    <div class="col-md-6">
        <canvas id="spendChart"></canvas>
    </div>
    <div class="col-md-6">
        <table class="table">
            <thead>
            <tr>
                <th>Product</th>
                <th>Total Purchased</th>
                <th>Total Spend</th>
                <th>Avg Price</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($metrics['top_products'] as $product): ?>
                <tr>
                    <td><?= h($product->product_name) ?> (<?= h($product->product_reference) ?>)</td>
                    <td><?= $this->Number->precision($product->total_quantity, 0) ?></td>
                    <td><?= $this->Number->currency($product->total_spend) ?></td>
                    <td><?= $this->Number->currency($product->avg_price) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<!--div class="category-spend">
    <h3>Spending by Category</h3>
    <table class="table">
        <thead>
        <tr>
            <th>Category</th>
            <th>Total Spend</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($metrics['category_spend'] as $category): ?>
            <tr>
                <td><?= h($category->category_name) ?></td>
                <td><?= $this->Number->currency($category->total_spend) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div-->
<!-- templates/YourController/supplier_performance.php -->

<div class="mt-3">
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100 TableData">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('N°') ?></th>
                    <th><?= $this->Paginator->sort('reference') ?></th>
                    <th><?= $this->Paginator->sort('shop_id') ?></th>
                    <th><?= $this->Paginator->sort('Bon d\'achats') ?></th>
                    <th><?= $this->Paginator->sort('Articles') ?></th>
                    <th><?= $this->Paginator->sort('Montant') ?></th>
                    <th><?= $this->Paginator->sort('Statut') ?></th>
                    <th><?= $this->Paginator->sort('Date') ?></th>
                    <th><?= $this->Paginator->sort('Par') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($purchasegroups as $purchasegroup): ?>
                <tr>
                    <td><?= $Number++ ?></td>
                    <td><?= h($purchasegroup->reference) ?></td>
                    <td><?= GeneralController::getNameOf($purchasegroup->shop_id, 'Shops') ?></td>
                    <td><?= GeneralController::getPurchasesNumber($purchasegroup->reference) ?> bon(s)</td>
                    <td class="text-center">
                        <span class="avatar avatar-sm avatar-rounded bg-success">
                            <?= GeneralController::getPurchasesItemsNumber($purchasegroup->reference) ?>
                        </span>
                    </td>
                    <td><?= GeneralController::getPurchasesItemsAmount($purchasegroup->reference) ?></td>
                    <td><?= GeneralController::getPurchasesGroupStatus($purchasegroup->reference) ?></td>
                    <td><?= h($purchasegroup->created) ?></td>
                    <td><?= h($purchasegroup->createdby) ?></td>
                    <td class="text-end">
                        <?= $this->Html->link(__('<i class="ri-eye-line"></i>'), ['action' => 'view', $purchasegroup->reference], ['class' => 'btn btn-success btn-sm', 'escape' => false]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php $this->Html->script('https://cdn.jsdelivr.net/npm/chart.js', ['block' => true]); ?>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const supplierData = <?= json_encode($supplierPerformance) ?>;

        // Extract data for charts
        const labels = supplierData.map(s => s.supplier_name);
        const spendData = supplierData.map(s => s.total_spend);
        const deliveryData = supplierData.map(s => s.avg_delivery_days);
        const orderData = supplierData.map(s => s.order_count);

        // Color generator
        function generateColors(count) {
            const colors = [];
            for(let i = 0; i < count; i++) {
                colors.push(`hsl(${(i * 360 / count)}, 70%, 60%)`);
            }
            return colors;
        }

        // 1. Total Spend by Supplier (Bar Chart)
        new Chart(document.getElementById('spendChart'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Spend',
                    data: spendData,
                    backgroundColor: generateColors(supplierData.length),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Total Spend by Supplier',
                        font: { size: 16 }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return '' + context.raw.toLocaleString('en-US', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
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
                                return '$' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });

        // 2. Delivery Performance (Radar Chart)
        new Chart(document.getElementById('deliveryChart'), {
            type: 'radar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Avg Delivery Days',
                        data: deliveryData,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        pointBackgroundColor: 'rgba(54, 162, 235, 1)',
                        pointRadius: 4
                    },
                    {
                        label: 'Order Count',
                        data: orderData,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        pointBackgroundColor: 'rgba(255, 99, 132, 1)',
                        pointRadius: 4
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Delivery Performance vs Order Volume',
                        font: { size: 16 }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label.includes('Delivery')) {
                                    return label + ': ' + context.raw.toFixed(1) + ' days';
                                }
                                return label + ': ' + context.raw;
                            }
                        }
                    }
                },
                scales: {
                    r: {
                        angleLines: { display: true },
                        suggestedMin: 0,
                        ticks: { precision: 0 }
                    }
                }
            }
        });

        // 3. Additional Pie Chart for Spend Distribution (optional)
        new Chart(document.getElementById('spendChart2'), {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: spendData,
                    backgroundColor: generateColors(supplierData.length),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Spend Distribution',
                        font: { size: 16 }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const value = context.raw;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((value / total) * 100);
                                return `${context.label}: $${value.toLocaleString()} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
    });
</script>
