<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profitability Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <h1 class="my-4">Profitability Prediction Dashboard</h1>
        
        <!-- Filters -->
        <div class="row mb-4">
            <div class="col-md-3">
                <label for="periodSelect" class="form-label">Time Period</label>
                <select id="periodSelect" class="form-select">
                    <option value="last_6_months">Last 6 Months</option>
                    <option value="last_year">Last Year</option>
                    <option value="custom">Custom Range</option>
                </select>
            </div>
            <div class="col-md-3" id="customRangeDiv" style="display: none;">
                <label for="startDate" class="form-label">Start Date</label>
                <input type="date" id="startDate" class="form-control">
                <label for="endDate" class="form-label">End Date</label>
                <input type="date" id="endDate" class="form-control">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button id="applyFilters" class="btn btn-primary">Apply</button>
            </div>
        </div>
        
        <!-- KPI Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card kpi-card">
                    <div class="card-body">
                        <h5 class="card-title">Gross Profit Margin</h5>
                        <h2 id="grossMarginKPI" class="card-text">0%</h2>
                        <p id="grossMarginTrend" class="card-text trend-text">→ No change</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card kpi-card">
                    <div class="card-body">
                        <h5 class="card-title">Net Profit Margin</h5>
                        <h2 id="netMarginKPI" class="card-text">0%</h2>
                        <p id="netMarginTrend" class="card-text trend-text">→ No change</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card kpi-card">
                    <div class="card-body">
                        <h5 class="card-title">Inventory Turnover</h5>
                        <h2 id="inventoryTurnoverKPI" class="card-text">0</h2>
                        <p id="inventoryTurnoverTrend" class="card-text trend-text">→ No change</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card kpi-card">
                    <div class="card-body">
                        <h5 class="card-title">Avg. CLV</h5>
                        <h2 id="clvKPI" class="card-text">$0</h2>
                        <p id="clvTrend" class="card-text trend-text">→ No change</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Charts -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Profit Margins Trend</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="profitChart" height="300"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Sales Forecast</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="forecastChart" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Break-Even Analysis</h5>
                    </div>
                    <div class="card-body">
                        <form id="breakEvenForm">
                            <div class="mb-3">
                                <label for="fixedCosts" class="form-label">Fixed Costs ($)</label>
                                <input type="number" class="form-control" id="fixedCosts" value="10000">
                            </div>
                            <div class="mb-3">
                                <label for="unitPrice" class="form-label">Unit Price ($)</label>
                                <input type="number" class="form-control" id="unitPrice" value="50">
                            </div>
                            <div class="mb-3">
                                <label for="variableCosts" class="form-label">Variable Costs per Unit ($)</label>
                                <input type="number" class="form-control" id="variableCosts" value="30">
                            </div>
                            <button type="button" id="calculateBtn" class="btn btn-primary">Calculate</button>
                        </form>
                        <div class="mt-3">
                            <h4 id="breakEvenResult">Break-Even Point: 0 units</h4>
                            <div id="breakEvenChart" style="height: 200px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Profitability Drivers</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="driversChart" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/d3@7"></script>
    <script src="assets/js/dashboard.js"></script>
</body>
</html>