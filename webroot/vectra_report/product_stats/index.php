<?php
require_once 'functions.php';

// Get all products for dropdown
$products = getAllProducts();

// Default to first product if none selected
$selected_product_id = isset($_GET['product_id']) ? (int)$_GET['product_id'] : ($products[0]['id'] ?? null);

// Get product details and metrics if a product is selected
$product_details = $selected_product_id ? getProductDetails($selected_product_id) : null;
$metrics = $selected_product_id ? calculateInventoryMetrics($selected_product_id) : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stock_style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation@1.0.2"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <title>Product Stat</title>
</head>
<body>
    <div class="dashboard-container">

        <!-- Product Selection -->
        <form method="GET">
            <label for="product_id">Selectionner le Produit:</label>
            <select class="form-select rounded-0" name="product_id" id="product_id" onchange="this.form.submit()">
                <?php foreach ($products as $product): ?>
                    <option value="<?= $product['id'] ?>" <?= $selected_product_id == $product['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($product['name']) ?> (<?= htmlspecialchars($product['reference']) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </form>

        <hr>

        <?php if ($product_details && $metrics): ?>
        <!-- Product Summary -->
        <div class="product-summary">
            <h2><?= htmlspecialchars($product_details['name']) ?></h2>
            <div class="product-details">
                <p><strong>Reference:</strong> <?= htmlspecialchars($product_details['reference']) ?></p>
                <p><strong>Barcode:</strong> <?= htmlspecialchars($product_details['barcode']) ?></p>
                <p><strong>Category:</strong> <?= htmlspecialchars($product_details['category']) ?></p>
                <p><strong>Supplier:</strong> <?= htmlspecialchars($product_details['supplier']) ?></p>
                <p><strong>Current Stock:</strong> <span class="highlight"><?= $metrics['current_stock'] ?></span></p>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="charts-section">
            <div class="chart-container">
                <canvas id="salesChart"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="inventoryChart"></canvas>
            </div>
        </div>

        <!-- Metrics Section -->
        <div class="metrics-section">
            <h3>Inventory Metrics</h3>
            <div class="">
                <div class="row">
                    <div class="col-sm-4 mb-3">
                        <div class="metric-card">
                            <h4>Average Daily Sales</h4>
                            <p class="metric-value"><?= $metrics['avg_daily_sales'] ?></p>
                            <p class="metric-description">Current daily sales</p>
                        </div>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <div class="metric-card">
                            <h4>Reorder Point</h4>
                            <p class="metric-value"><?= $metrics['reorder_point'] ?></p>
                            <p class="metric-description">Order when stock reaches this level</p>
                        </div>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <div class="metric-card">
                            <h4>Safety Stock</h4>
                            <p class="metric-value"><?= $metrics['safety_stock'] ?></p>
                            <p class="metric-description">Buffer for demand variability</p>
                        </div>
                    </div>
                    <hr>
                    <div class="col-sm-4">
                        <div class="metric-card">
                            <h4>Stock Coverage</h4>
                            <p class="metric-value"><?= $metrics['coverage_days'] ?> days</p>
                            <p class="metric-description">Current stock will last <?= $metrics['coverage_days'] ?> days</p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="metric-card">
                            <h4>Lead Time Demand</h4>
                            <p class="metric-value"><?= $metrics['lead_time_demand'] ?></p>
                            <p class="metric-description">Needed during <?= $metrics['lead_time_days'] ?>-day lead time</p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="metric-card">
                            <h4>30-Day Forecast</h4>
                            <p class="metric-value"><?= $metrics['forecast_30days'] ?></p>
                            <p class="metric-description">Expected sales in next 30 days</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recommendation Section -->
        <div class="recommendation-section">
            <h3>Stock Recommendation</h3>
            <?php
            $recommended_order = max(0, $metrics['reorder_point'] - $metrics['current_stock']);
            $urgency = '';
            $urgency_class = '';

            if ($metrics['current_stock'] <= $metrics['safety_stock']) {
                $urgency = 'URGENT - Stock critically low!';
                $urgency_class = 'urgent';
            } elseif ($metrics['current_stock'] <= $metrics['reorder_point']) {
                $urgency = 'Order needed soon';
                $urgency_class = 'warning';
            } else {
                $urgency = 'Stock level OK';
                $urgency_class = 'ok';
            }
            ?>
            <div class="recommendation-card <?= $urgency_class ?>">
                <p><strong>Status:</strong> <span><?= $urgency ?></span></p>
                <?php if ($recommended_order > 0): ?>
                    <p><strong>Recommended Order Quantity:</strong> <?= ceil($recommended_order) ?></p>
                <?php else: ?>
                    <p>No order needed at this time.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Raw Data Section (optional) -->
        <div class="raw-data-section">
            <h3>Sales Data (Last 90 Days)</h3>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Quantity Sold</th>
                        <th>Revenue</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($metrics['sales_data'] as $sale): ?>
                        <tr>
                            <td><?= htmlspecialchars($sale['date']) ?></td>
                            <td><?= $sale['total_qty'] ?></td>
                            <td><?= number_format($sale['total_revenue'], 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?php else: ?>
            <div class="no-product">
                <p>No product selected or no data available.</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- JavaScript -->
    <script>
        // Pass PHP data to JavaScript
        const productData = {
            productId: <?= $selected_product_id ?: 'null' ?>,
            currentStock: <?= $metrics['current_stock'] ?? 0 ?>,
            reorderPoint: <?= $metrics['reorder_point'] ?? 0 ?>,
            safetyStock: <?= $metrics['safety_stock'] ?? 0 ?>,
            salesData: <?= json_encode($metrics['sales_data'] ?? []) ?>
        };
    </script>
    <script src="stock_dashboard.js"></script>
</body>
</html>
