document.addEventListener('DOMContentLoaded', function() {
    // Verify all required elements exist
    const requiredElements = [
        'critical-count', 'low-count', 'avg-turnover',
        'top-supplier', 'supplier-score'
    ];
    
    requiredElements.forEach(id => {
        if (!document.getElementById(id)) {
            console.error(`Required element #${id} missing from DOM`);
        }
    });

    // Load data
    loadDashboardData().catch(error => {
        console.error('Dashboard initialization failed:', error);
        showError('main-container', 'Failed to load dashboard data');
    });
});

function showLoadingState() {
    document.querySelectorAll('.card-body').forEach(el => {
        if (!el.querySelector('.loading')) {
            const loadingEl = document.createElement('div');
            loadingEl.className = 'loading text-muted';
            loadingEl.textContent = 'Loading data...';
            el.innerHTML = '';
            el.appendChild(loadingEl);
        }
    });
}

async function loadDashboardData() {
    try {
        const [inventoryData, supplierData, recommendations] = await Promise.all([
            fetchData('inventory_metrics').catch(e => {
                console.error('Inventory error:', e);
                showError('inventory-charts', 'Failed to load inventory data');
                return [];
            }),
            fetchData('supplier_performance').catch(e => {
                console.error('Supplier error:', e);
                showError('supplier-charts', 'Failed to load supplier data');
                return [];
            }),
            fetchData('purchase_recommendations').catch(e => {
                console.error('Recommendations error:', e);
                showError('recommendations-container', 'Failed to load recommendations');
                return [];
            })
        ]);

        // Verify data
        if (!Array.isArray(inventoryData)) throw new Error('Invalid inventory data');
        if (!Array.isArray(supplierData)) throw new Error('Invalid supplier data');
        if (!Array.isArray(recommendations)) throw new Error('Invalid recommendations');

        // Update UI
        updateSummaryCards(inventoryData, supplierData);
        createTurnoverChart(inventoryData);
        createDaysOfStockChart(inventoryData);
        createSupplierRadarChart(supplierData);
        createDeliveryChart(supplierData);
        populateInventoryTable(inventoryData);
        populateRecommendationsTable(recommendations);

    } catch (error) {
        console.error('Dashboard initialization failed:', error);
        showError(false, 'Failed to initialize dashboard. Please try again later.');
    }
}

// Fetch data from API
function fetchData(action) {
    return fetch(`dashboard_api.php?action=${action}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                throw new Error(data.error);
            }
            return data;
        });
}

// Improved element handling
function getSafeElement(id, fallbackContent = '') {
    let element = document.getElementById(id);
    if (!element) {
        console.warn(`Element with ID ${id} not found, creating fallback`);
        element = document.createElement('div');
        element.id = id;
        element.innerHTML = fallbackContent;
        document.body.appendChild(element);
    }
    return element;
}

// Updated updateSummaryCards function
function updateSummaryCards(inventoryData = [], supplierData = []) {
    try {
        // Safely get all elements
        const elements = {
            criticalCount: getSafeElement('critical-count', '0'),
            lowCount: getSafeElement('low-count', '0'),
            avgTurnover: getSafeElement('avg-turnover', '0.00'),
            topSupplier: getSafeElement('top-supplier', '-'),
            supplierScore: getSafeElement('supplier-score', 'Score: N/A')
        };

        // Calculate metrics with defaults
        const criticalCount = inventoryData.filter(item => 
            item && item.stock_status === 'CRITICAL'
        ).length || 0;
        
        const lowCount = inventoryData.filter(item => 
            item && item.stock_status === 'LOW'
        ).length || 0;

        const validTurnover = inventoryData.filter(item => 
            item && !isNaN(item.turnover_rate) && isFinite(item.turnover_rate)
        );
        
        const avgTurnover = validTurnover.length > 0 
            ? (validTurnover.reduce((sum, item) => sum + parseFloat(item.turnover_rate), 0) / validTurnover.length).toFixed(2)
            : '0.00';

        // Get top supplier data safely
        const topSupplier = supplierData[0] || null;
        const supplierName = topSupplier?.name || 'N/A';
        const supplierScore = topSupplier?.performance_score !== undefined 
            ? parseFloat(topSupplier.performance_score).toFixed(1) 
            : 'N/A';

        // Update elements
        elements.criticalCount.textContent = criticalCount;
        elements.lowCount.textContent = lowCount;
        elements.avgTurnover.textContent = avgTurnover;
        elements.topSupplier.textContent = supplierName;
        elements.supplierScore.textContent = `Score: ${supplierScore}`;

    } catch (error) {
        console.error('Error updating summary cards:', error);
        showError('summary-section', 'Failed to update summary data');
    }
}

// Helper function to create fallback elements
function createFallbackElement(id) {
    console.warn(`Element with ID ${id} not found, creating fallback`);
    const el = document.createElement('div');
    el.id = id;
    document.body.appendChild(el);
    return el;
}

// Helper function to show errors in UI
function showError(containerId, message) {
    const container = document.getElementById(containerId) || document.querySelector('.container-fluid');
    if (container) {
        const errorEl = document.createElement('div');
        errorEl.className = 'alert alert-danger';
        errorEl.textContent = message;
        container.prepend(errorEl);
    }
}

// Create stock turnover chart
function createTurnoverChart(data) {
    // Sort by turnover rate (descending) and take top 10
    const sortedData = [...data]
        .sort((a, b) => b.turnover_rate - a.turnover_rate)
        .slice(0, 10);
    
    const ctx = document.getElementById('turnoverChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: sortedData.map(item => item.name),
            datasets: [{
                label: 'Stock Turnover Rate',
                data: sortedData.map(item => item.turnover_rate),
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `Turnover: ${context.raw.toFixed(2)}`;
                        }
                    }
                }
            },
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

// Create days of stock chart
function createDaysOfStockChart(data) {
    // Sort by days of stock (ascending) and take top 10
    const sortedData = [...data]
        .filter(item => !isNaN(item.days_of_stock) && isFinite(item.days_of_stock))
        .sort((a, b) => a.days_of_stock - b.days_of_stock)
        .slice(0, 10);
    
    const ctx = document.getElementById('daysOfStockChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: sortedData.map(item => item.name),
            datasets: [{
                label: 'Days of Stock Remaining',
                data: sortedData.map(item => item.days_of_stock),
                backgroundColor: sortedData.map(item => 
                    item.days_of_stock < 7 ? 'rgba(255, 99, 132, 0.7)' :
                    item.days_of_stock < 14 ? 'rgba(255, 159, 64, 0.7)' :
                    'rgba(75, 192, 192, 0.7)'
                ),
                borderColor: sortedData.map(item => 
                    item.days_of_stock < 7 ? 'rgba(255, 99, 132, 1)' :
                    item.days_of_stock < 14 ? 'rgba(255, 159, 64, 1)' :
                    'rgba(75, 192, 192, 1)'
                ),
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `Days: ${context.raw.toFixed(1)}`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Days of Stock'
                    }
                }
            }
        }
    });
}

// Create supplier radar chart
function createSupplierRadarChart(data) {
    // Take top 3 suppliers with valid data
    const topSuppliers = data.slice(0, 3).filter(supplier => 
        supplier && supplier.performance_score !== null
    );
    
    if (topSuppliers.length === 0) {
        document.getElementById('supplierRadarChart').closest('.card').innerHTML = `
            <div class="card-header">Supplier Performance Radar</div>
            <div class="card-body">
                <p class="text-muted">No supplier performance data available</p>
            </div>
        `;
        return;
    }
    
    const ctx = document.getElementById('supplierRadarChart').getContext('2d');
    new Chart(ctx, {
        type: 'radar',
        data: {
            labels: ['On-Time Delivery', 'Low Defect Rate', 'Price Stability', 'Fast Lead Time', 'Payment Reliability'],
            datasets: topSuppliers.map((supplier, index) => ({
                label: supplier.name,
                data: [
                    supplier.on_time_rate || 0,
                    (100 - (supplier.defect_rate || 0)) || 0,
                    supplier.avg_price ? (100 - ((supplier.price_stddev || 0) / supplier.avg_price * 100)) || 0 : 0,
                    supplier.avg_lead_time ? (100 - (supplier.avg_lead_time / 14 * 100)) || 0 : 0,
                    (100 - (supplier.late_payment_rate || 0)) || 0
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)'
                ][index],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ][index],
                borderWidth: 2
            }))
        },
        options: {
            responsive: true,
            scales: {
                r: {
                    angleLines: {
                        display: true
                    },
                    suggestedMin: 0,
                    suggestedMax: 100
                }
            }
        }
    });
}

// Create delivery performance chart
function createDeliveryChart(data) {
    // Sort by on-time rate and take top 5
    const sortedData = [...data]
        .sort((a, b) => b.on_time_rate - a.on_time_rate)
        .slice(0, 5);
    
    const ctx = document.getElementById('deliveryChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: sortedData.map(item => item.name),
            datasets: [{
                label: 'On-Time Delivery Rate (%)',
                data: sortedData.map(item => item.on_time_rate),
                backgroundColor: 'rgba(75, 192, 192, 0.7)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }, {
                label: 'Defect Rate (%)',
                data: sortedData.map(item => item.defect_rate),
                backgroundColor: 'rgba(255, 99, 132, 0.7)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    title: {
                        display: true,
                        text: 'Percentage (%)'
                    }
                }
            }
        }
    });
}

// Populate inventory table
function populateInventoryTable(data) {
    const tbody = document.querySelector('#inventoryTable tbody');
    tbody.innerHTML = '';
    
    data.forEach(item => {
        const row = document.createElement('tr');
        row.className = item.stock_status.toLowerCase();
        
        row.innerHTML = `
            <td>${item.name}</td>
            <td>${item.reference}</td>
            <td>${item.stock}</td>
            <td>${item.stock_min}</td>
            <td>${item.stock_max}</td>
            <td>${item.turnover_rate}</td>
            <td>${item.days_of_stock}</td>
            <td>${item.stock_status}</td>
        `;
        
        tbody.appendChild(row);
    });
}

// Populate recommendations table
function populateRecommendationsTable(data) {
    const tbody = document.querySelector('#recommendationsTable tbody');
    tbody.innerHTML = '';
    
    if (data.length === 0) {
        const row = document.createElement('tr');
        row.innerHTML = '<td colspan="7" class="text-center">No critical purchase recommendations at this time</td>';
        tbody.appendChild(row);
        return;
    }
    
    data.forEach(item => {
        const row = document.createElement('tr');
        row.className = item.urgency.toLowerCase().includes('high') ? 'high-urgency' : 'medium-urgency';
        
        row.innerHTML = `
            <td>${item.product_name} (${item.product_reference})</td>
            <td>${item.current_stock}</td>
            <td>${item.qty_needed}</td>
            <td>${item.supplier_name}</td>
            <td>$${item.supplier_price.toFixed(2)}</td>
            <td>${item.estimated_lead_time.toFixed(1)} days</td>
            <td>${item.urgency}</td>
        `;
        
        tbody.appendChild(row);
    });
}