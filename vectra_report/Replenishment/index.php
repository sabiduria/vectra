<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Inventory & Supplier Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <style>
        .card {
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .card-header {
            font-weight: bold;
            background-color: #f8f9fa;
        }
        .critical {
            background-color: #ffdddd;
        }
        .low {
            background-color: #fff3cd;
        }
        .ok {
            background-color: #d4edda;
        }
        .high-urgency {
            background-color: #ffcccc;
        }
        .medium-urgency {
            background-color: #ffe6cc;
        }
    </style>
</head>
<body>
    <div class="container-fluid mt-4">
        <h1 class="text-center mb-4">Advanced Inventory & Supplier Dashboard</h1>
        
        <div class="row">
            <!-- Inventory Summary Cards -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">Critical Stock Items</div>
                    <div class="card-body">
                        <h2 id="critical-count" class="text-danger">0</h2>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">Low Stock Items</div>
                    <div class="card-body">
                        <h2 id="low-count" class="text-warning">0</h2>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">Avg Stock Turnover</div>
                    <div class="card-body">
                        <h2 id="avg-turnover">0</h2>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">Top Performing Supplier</div>
                    <div class="card-body">
                        <h4 id="top-supplier">-</h4>
                        <p id="supplier-score" class="mb-0">Score: 0</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-4">
            <!-- Inventory Charts -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Stock Turnover Rate</div>
                    <div class="card-body">
                        <canvas id="turnoverChart" height="300"></canvas>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Days of Stock Remaining</div>
                    <div class="card-body">
                        <canvas id="daysOfStockChart" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-4">
            <!-- Supplier Charts -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Supplier Performance Radar</div>
                    <div class="card-body">
                        <canvas id="supplierRadarChart" height="300"></canvas>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Supplier On-Time Delivery</div>
                    <div class="card-body">
                        <canvas id="deliveryChart" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-4">
            <!-- Purchase Recommendations -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Purchase Recommendations</div>
                    <div class="card-body">
                        <table class="table table-striped" id="recommendationsTable">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Current Stock</th>
                                    <th>Recommended Qty</th>
                                    <th>Recommended Supplier</th>
                                    <th>Unit Price</th>
                                    <th>Lead Time</th>
                                    <th>Urgency</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-4">
            <!-- Inventory Status Table -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Inventory Status</div>
                    <div class="card-body">
                        <table class="table table-striped" id="inventoryTable">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Reference</th>
                                    <th>Current Stock</th>
                                    <th>Min Stock</th>
                                    <th>Max Stock</th>
                                    <th>Turnover Rate</th>
                                    <th>Days of Stock</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="dashboard.js"></script>
</body>
</html>