document.addEventListener('DOMContentLoaded', function() {
    // Global chart references
    let profitChart, forecastChart, driversChart;
    
    // DOM Elements
    const periodSelect = document.getElementById('periodSelect');
    const customRangeDiv = document.getElementById('customRangeDiv');
    const applyFiltersBtn = document.getElementById('applyFilters');
    const calculateBtn = document.getElementById('calculateBtn');
    const breakEvenResult = document.getElementById('breakEvenResult');
    
    // Event Listeners
    periodSelect.addEventListener('change', toggleCustomRange);
    applyFiltersBtn.addEventListener('click', loadDashboardData);
    calculateBtn.addEventListener('click', calculateBreakEven);
    
    // Initialize dashboard
    loadDashboardData();
    
    function toggleCustomRange() {
        customRangeDiv.style.display = periodSelect.value === 'custom' ? 'block' : 'none';
    }
    
    function loadDashboardData() {
        let apiUrl, params = {};
        
        if (periodSelect.value === 'custom') {
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;
            
            if (!startDate || !endDate) {
                alert('Please select both start and end dates');
                return;
            }
            
            params = { startDate, endDate };
            apiUrl = 'api/profit_metrics.php?' + new URLSearchParams(params);
        } else {
            params = { period: periodSelect.value };
            apiUrl = 'api/profit_metrics.php?' + new URLSearchParams(params);
        }
        
        // Fetch profit metrics
        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                updateKPICards(data);
                renderProfitChart(data);
                renderDriversChart(data);
            })
            .catch(error => console.error('Error:', error));
        
        // Fetch sales data for forecast
        fetch('api/sales_data.php?' + new URLSearchParams(params))
            .then(response => response.json())
            .then(data => {
                renderForecastChart(data);
            })
            .catch(error => console.error('Error:', error));
    }
    
    function updateKPICards(data) {
        if (data.length === 0) return;
        
        // Get current and previous period data
        const current = data[data.length - 1];
        const previous = data.length > 1 ? data[data.length - 2] : current;
        
        // Gross Profit Margin
        const grossMarginKPI = document.getElementById('grossMarginKPI');
        const grossMarginTrend = document.getElementById('grossMarginTrend');
        grossMarginKPI.textContent = current.gross_profit.toFixed(1) + '%';
        updateTrendIndicator(grossMarginTrend, current.gross_profit, previous.gross_profit);
        
        // Net Profit Margin
        const netMarginKPI = document.getElementById('netMarginKPI');
        const netMarginTrend = document.getElementById('netMarginTrend');
        netMarginKPI.textContent = current.net_profit.toFixed(1) + '%';
        updateTrendIndicator(netMarginTrend, current.net_profit, previous.net_profit);
        
        // Inventory Turnover (simplified calculation)
        const inventoryTurnoverKPI = document.getElementById('inventoryTurnoverKPI');
        const inventoryTurnoverTrend = document.getElementById('inventoryTurnoverTrend');
        const currentTurnover = current.cogs / (current.cogs / 4); // Simplified
        const previousTurnover = previous.cogs / (previous.cogs / 4);
        inventoryTurnoverKPI.textContent = currentTurnover.toFixed(1);
        updateTrendIndicator(inventoryTurnoverTrend, currentTurnover, previousTurnover);
        
        // Customer Lifetime Value (simplified)
        const clvKPI = document.getElementById('clvKPI');
        const clvTrend = document.getElementById('clvTrend');
        const currentCLV = current.revenue * 0.2; // Simplified (20% of revenue)
        const previousCLV = previous.revenue * 0.2;
        clvKPI.textContent = '$' + currentCLV.toFixed(0);
        updateTrendIndicator(clvTrend, currentCLV, previousCLV);
    }
    
    function updateTrendIndicator(element, currentValue, previousValue) {
        const diff = currentValue - previousValue;
        const absDiff = Math.abs(diff);
        
        element.textContent = diff > 0 ? `↑ ${absDiff.toFixed(1)}` : 
                             diff < 0 ? `↓ ${absDiff.toFixed(1)}` : '→ No change';
        
        element.className = 'card-text trend-text ' + 
                           (diff > 0 ? 'trend-up' : 
                            diff < 0 ? 'trend-down' : 'trend-neutral');
    }
    
    function renderProfitChart(data) {
        const ctx = document.getElementById('profitChart').getContext('2d');
        
        // Destroy previous chart if it exists
        if (profitChart) {
            profitChart.destroy();
        }
        
        profitChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.map(item => item.month),
                datasets: [
                    {
                        label: 'Gross Profit Margin %',
                        data: data.map(item => item.gross_profit),
                        borderColor: '#4CAF50',
                        backgroundColor: 'rgba(76, 175, 80, 0.1)',
                        tension: 0.3,
                        fill: true
                    },
                    {
                        label: 'Net Profit Margin %',
                        data: data.map(item => item.net_profit),
                        borderColor: '#2196F3',
                        backgroundColor: 'rgba(33, 150, 243, 0.1)',
                        tension: 0.3,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Profit Margins Over Time'
                    },
                    tooltip: {
                        callbacks: {
                            afterLabel: function(context) {
                                const index = context.dataIndex;
                                return [
                                    `Revenue: $${data[index].revenue.toFixed(2)}`,
                                    `COGS: $${data[index].cogs.toFixed(2)}`,
                                    `Expenses: $${data[index].expenses.toFixed(2)}`
                                ];
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Percentage (%)'
                        }
                    }
                }
            }
        });
    }
    
    function renderForecastChart(data) {
        const ctx = document.getElementById('forecastChart').getContext('2d');
        
        // Simple forecasting (linear regression)
        const labels = data.map(item => item.period);
        const salesData = data.map(item => item.total_sales);
        
        // Add forecasted months (simple linear projection)
        const forecastMonths = 3;
        const lastValue = salesData[salesData.length - 1];
        const avgGrowth = (lastValue - salesData[0]) / (salesData.length - 1);
        
        const forecastLabels = [...labels];
        const forecastValues = [...salesData];
        
        for (let i = 1; i <= forecastMonths; i++) {
            forecastLabels.push(`F${i}`);
            forecastValues.push(lastValue + (avgGrowth * i));
        }
        
        // Destroy previous chart if it exists
        if (forecastChart) {
            forecastChart.destroy();
        }
        
        forecastChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: forecastLabels,
                datasets: [
                    {
                        label: 'Actual Sales',
                        data: salesData,
                        borderColor: '#FF5722',
                        backgroundColor: 'rgba(255, 87, 34, 0.1)',
                        tension: 0.3,
                        fill: true
                    },
                    {
                        label: 'Forecasted Sales',
                        data: [...Array(salesData.length).fill(null), ...forecastValues.slice(salesData.length)],
                        borderColor: '#9C27B0',
                        backgroundColor: 'rgba(156, 39, 176, 0.1)',
                        borderDash: [5, 5],
                        tension: 0.3,
                        fill: false
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Sales Trend & Forecast'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        title: {
                            display: true,
                            text: 'Sales Amount ($)'
                        }
                    }
                }
            }
        });
    }
    
    function renderDriversChart(data) {
        const ctx = document.getElementById('driversChart').getContext('2d');
        
        // Destroy previous chart if it exists
        if (driversChart) {
            driversChart.destroy();
        }
        
        // Get the most recent data point
        const latest = data[data.length - 1];
        
        driversChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Revenue', 'COGS', 'Expenses', 'Profit'],
                datasets: [{
                    label: 'Amount ($)',
                    data: [
                        latest.revenue,
                        latest.cogs,
                        latest.expenses,
                        latest.revenue - latest.cogs - latest.expenses
                    ],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(255, 159, 64, 0.6)',
                        'rgba(75, 192, 192, 0.6)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Profitability Drivers'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += '$' + context.raw.toFixed(2);
                                
                                // Add percentage for all except profit
                                if (context.dataIndex < 3) {
                                    const total = latest.revenue;
                                    label += ` (${((context.raw / total) * 100).toFixed(1)}%)`;
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Amount ($)'
                        }
                    }
                }
            }
        });
    }
    
    function calculateBreakEven() {
        const fixedCosts = parseFloat(document.getElementById('fixedCosts').value);
        const unitPrice = parseFloat(document.getElementById('unitPrice').value);
        const variableCosts = parseFloat(document.getElementById('variableCosts').value);
        
        if (isNaN(fixedCosts)) {
            alert('Please enter valid fixed costs');
            return;
        }
        
        if (isNaN(unitPrice) || unitPrice <= 0) {
            alert('Please enter valid unit price');
            return;
        }
        
        if (isNaN(variableCosts)) {
            alert('Please enter valid variable costs');
            return;
        }
        
        const contributionMargin = unitPrice - variableCosts;
        
        if (contributionMargin <= 0) {
            alert('Unit price must be greater than variable costs');
            return;
        }
        
        const breakEvenUnits = Math.ceil(fixedCosts / contributionMargin);
        const breakEvenRevenue = breakEvenUnits * unitPrice;
        
        breakEvenResult.innerHTML = `
            Break-Even Point: <strong>${breakEvenUnits} units</strong> 
            or <strong>$${breakEvenRevenue.toFixed(2)} in revenue</strong>
        `;
        
        // Create break-even chart with D3.js
        createBreakEvenChart(fixedCosts, unitPrice, variableCosts, breakEvenUnits);
    }
    
    function createBreakEvenChart(fixedCosts, unitPrice, variableCosts, breakEvenUnits) {
        const margin = {top: 20, right: 30, bottom: 40, left: 50};
        const width = 500 - margin.left - margin.right;
        const height = 200 - margin.top - margin.bottom;
        
        // Clear previous chart
        d3.select("#breakEvenChart").html("");
        
        // Create SVG
        const svg = d3.select("#breakEvenChart")
            .append("svg")
            .attr("width", width + margin.left + margin.right)
            .attr("height", height + margin.top + margin.bottom)
            .append("g")
            .attr("transform", `translate(${margin.left},${margin.top})`);
        
        // Calculate max units for x-axis (break-even + 50%)
        const maxUnits = Math.round(breakEvenUnits * 1.5);
        
        // Generate data points
        const data = [];
        for (let units = 0; units <= maxUnits; units += Math.round(maxUnits / 10)) {
            const revenue = units * unitPrice;
            const totalCost = fixedCosts + (units * variableCosts);
            data.push({
                units,
                revenue,
                totalCost,
                profit: revenue - totalCost
            });
        }
        
        // Scales
        const x = d3.scaleLinear()
            .domain([0, maxUnits])
            .range([0, width]);
        
        const y = d3.scaleLinear()
            .domain([0, d3.max(data, d => Math.max(d.revenue, d.totalCost))])
            .range([height, 0]);
        
        // Add X axis
        svg.append("g")
            .attr("transform", `translate(0,${height})`)
            .call(d3.axisBottom(x).ticks(5).tickFormat(d => `${d} units`));
        
        // Add Y axis
        svg.append("g")
            .call(d3.axisLeft(y).tickFormat(d => `$${d}`));
        
        // Revenue line
        svg.append("path")
            .datum(data)
            .attr("fill", "none")
            .attr("stroke", "#4CAF50")
            .attr("stroke-width", 2)
            .attr("d", d3.line()
                .x(d => x(d.units))
                .y(d => y(d.revenue))
            );
        
        // Total cost line
        svg.append("path")
            .datum(data)
            .attr("fill", "none")
            .attr("stroke", "#F44336")
            .attr("stroke-width", 2)
            .attr("d", d3.line()
                .x(d => x(d.units))
                .y(d => y(d.totalCost))
            );
        
        // Fixed cost line
        svg.append("line")
            .attr("x1", 0)
            .attr("x2", x(breakEvenUnits))
            .attr("y1", y(fixedCosts))
            .attr("y2", y(fixedCosts))
            .attr("stroke", "#FF9800")
            .attr("stroke-width", 1)
            .attr("stroke-dasharray", "5,5");
        
        // Break-even point
        svg.append("circle")
            .attr("cx", x(breakEvenUnits))
            .attr("cy", y(breakEvenUnits * unitPrice))
            .attr("r", 5)
            .attr("fill", "#9C27B0");
        
        // Legend
        const legend = svg.append("g")
            .attr("transform", `translate(${width - 150}, 10)`);
        
        legend.append("rect")
            .attr("width", 12)
            .attr("height", 12)
            .attr("fill", "#4CAF50");
        legend.append("text")
            .attr("x", 20)
            .attr("y", 10)
            .text("Revenue")
            .style("font-size", "10px");
        
        legend.append("rect")
            .attr("y", 20)
            .attr("width", 12)
            .attr("height", 12)
            .attr("fill", "#F44336");
        legend.append("text")
            .attr("x", 20)
            .attr("y", 30)
            .text("Total Cost")
            .style("font-size", "10px");
        
        legend.append("line")
            .attr("x1", 0)
            .attr("x2", 12)
            .attr("y1", 40)
            .attr("y2", 40)
            .attr("stroke", "#FF9800")
            .attr("stroke-width", 1)
            .attr("stroke-dasharray", "5,5");
        legend.append("text")
            .attr("x", 20)
            .attr("y", 40)
            .text("Fixed Cost")
            .style("font-size", "10px");
        
        legend.append("circle")
            .attr("cx", 6)
            .attr("cy", 55)
            .attr("r", 4)
            .attr("fill", "#9C27B0");
        legend.append("text")
            .attr("x", 20)
            .attr("y", 55)
            .text("Break-Even")
            .style("font-size", "10px");
    }
});