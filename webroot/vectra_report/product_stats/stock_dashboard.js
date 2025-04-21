document.addEventListener('DOMContentLoaded', function() {
    if (!productData.productId) return;
    
    // Initialize charts
    initSalesChart();
    initInventoryChart();
    
    // Set up auto-refresh every 5 minutes
    setInterval(() => {
        fetchSalesData();
    }, 300000);
});

function initSalesChart() {
    const ctx = document.getElementById('salesChart').getContext('2d');
    
    // Prepare data
    const dates = productData.salesData.map(item => item.date);
    const quantities = productData.salesData.map(item => item.total_qty);
    const revenues = productData.salesData.map(item => item.total_revenue);
    
    // Calculate 7-day moving average
    const movingAvg = calculateMovingAverage(quantities, 7);
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: dates,
            datasets: [
                {
                    label: 'Daily Sales (Units)',
                    data: quantities,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.1)',
                    borderWidth: 2,
                    tension: 0.1,
                    yAxisID: 'y'
                },
                {
                    label: '7-Day Moving Avg',
                    data: movingAvg,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.1)',
                    borderWidth: 2,
                    borderDash: [5, 5],
                    tension: 0.1,
                    yAxisID: 'y'
                },
                {
                    label: 'Revenue ($)',
                    data: revenues,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.1)',
                    borderWidth: 2,
                    type: 'bar',
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
                    title: {
                        display: true,
                        text: 'Units Sold'
                    }
                },
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    grid: {
                        drawOnChartArea: false,
                    },
                    title: {
                        display: true,
                        text: 'Revenue ($)'
                    }
                },
                x: {
                    ticks: {
                        maxRotation: 45,
                        minRotation: 45
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
                            if (context.datasetIndex === 2) {
                                label += '$' + context.raw.toFixed(2);
                            } else {
                                label += context.raw.toFixed(2);
                            }
                            return label;
                        }
                    }
                },
                annotation: {
                    annotations: {
                        reorderPoint: {
                            type: 'line',
                            yMin: productData.reorderPoint,
                            yMax: productData.reorderPoint,
                            borderColor: 'red',
                            borderWidth: 2,
                            borderDash: [6, 6],
                            label: {
                                content: 'Reorder Point: ' + productData.reorderPoint,
                                enabled: true,
                                position: 'left'
                            }
                        },
                        safetyStock: {
                            type: 'line',
                            yMin: productData.safetyStock,
                            yMax: productData.safetyStock,
                            borderColor: 'orange',
                            borderWidth: 2,
                            borderDash: [6, 6],
                            label: {
                                content: 'Safety Stock: ' + productData.safetyStock,
                                enabled: true,
                                position: 'left'
                            }
                        }
                    }
                }
            }
        }
    });
}

function initInventoryChart() {
    const ctx = document.getElementById('inventoryChart').getContext('2d');
    
    // Simulate future stock levels based on average sales
    const forecastDays = 30;
    const avgDailySales = productData.salesData.reduce((sum, day) => sum + day.total_qty, 0) / productData.salesData.length;
    const currentStock = productData.currentStock;
    
    const forecastDates = [];
    const forecastStock = [];
    let remainingStock = currentStock;
    
    // Generate forecast data
    for (let i = 0; i < forecastDays; i++) {
        const date = new Date();
        date.setDate(date.getDate() + i);
        forecastDates.push(date.toISOString().split('T')[0]);
        
        remainingStock = Math.max(0, remainingStock - avgDailySales);
        forecastStock.push(remainingStock);
    }
    
    // Find when stock hits reorder point
    const reorderDay = forecastStock.findIndex(stock => stock <= productData.reorderPoint);
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: forecastDates,
            datasets: [
                {
                    label: 'Projected Stock Level',
                    data: forecastStock,
                    borderColor: 'rgba(153, 102, 255, 1)',
                    backgroundColor: 'rgba(153, 102, 255, 0.1)',
                    borderWidth: 2,
                    tension: 0.1,
                    fill: true
                },
                {
                    label: 'Reorder Point',
                    data: Array(forecastDays).fill(productData.reorderPoint),
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.1)',
                    borderWidth: 2,
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
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += context.raw.toFixed(2);
                            return label;
                        },
                        footer: function(context) {
                            if (context[0].datasetIndex === 0 && context[0].dataIndex === reorderDay) {
                                return 'Stock reaches reorder point on this day';
                            }
                        }
                    }
                },
                annotation: {
                    annotations: {
                        highlightReorderDay: {
                            type: 'box',
                            xMin: reorderDay >= 0 ? forecastDates[reorderDay] : null,
                            xMax: reorderDay >= 0 ? forecastDates[reorderDay] : null,
                            backgroundColor: 'rgba(255, 99, 132, 0.25)',
                            borderWidth: 0
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Stock Level'
                    }
                },
                x: {
                    ticks: {
                        maxRotation: 45,
                        minRotation: 45
                    }
                }
            }
        }
    });
}

function calculateMovingAverage(data, windowSize) {
    return data.map((_, index, array) => {
        const start = Math.max(0, index - windowSize + 1);
        const subset = array.slice(start, index + 1);
        return subset.reduce((a, b) => a + b, 0) / subset.length;
    });
}

function fetchSalesData() {
    fetch(`api.php?action=get_sales_data&product_id=${productData.productId}`)
        .then(response => response.json())
        .then(data => {
            console.log('Updated sales data:', data);
            // Here you would update the charts with new data
            // For simplicity, we'll just reload the page
            window.location.reload();
        })
        .catch(error => {
            console.error('Error fetching sales data:', error);
        });
}