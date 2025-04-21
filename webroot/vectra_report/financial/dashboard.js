// Dashboard Manager
class DashboardManager {
    constructor() {
        this.charts = {
            inventoryByCategory: null,
            salesCogs: null,
            stockMovement: null,
            purchasesExpenses: null
        };
        this.currentFilters = {
            startDate: null,
            endDate: null,
            shopId: 'all'
        };
    }

    // Initialize the dashboard
    async init() {
        this.setupDatePickers();
        await this.loadShops();
        this.setupEventListeners();
        this.initializeEmptyCharts();
        await this.loadData();
    }

    // Setup date pickers with default range (last 30 days)
    setupDatePickers() {
        const endDate = new Date();
        const startDate = new Date();
        startDate.setDate(endDate.getDate() - 30);
        
        document.getElementById('startDate').valueAsDate = startDate;
        document.getElementById('endDate').valueAsDate = endDate;
        
        this.currentFilters.startDate = startDate.toISOString().split('T')[0];
        this.currentFilters.endDate = endDate.toISOString().split('T')[0];
    }

    // Load shops for filter dropdown
    async loadShops() {
        try {
            const response = await fetch('api.php?action=getShops');
            const data = await response.json();
            const shopFilter = document.getElementById('shopFilter');
            
            data.forEach(shop => {
                const option = document.createElement('option');
                option.value = shop.id;
                option.textContent = shop.name;
                shopFilter.appendChild(option);
            });
        } catch (error) {
            console.error('Failed to load shops:', error);
        }
    }

    // Setup event listeners
    setupEventListeners() {
        document.getElementById('dateRangeForm').addEventListener('submit', (e) => {
            e.preventDefault();
            this.updateFilters();
            this.loadData();
        });
    }

    // Update current filters from form
    updateFilters() {
        this.currentFilters = {
            startDate: document.getElementById('startDate').value,
            endDate: document.getElementById('endDate').value,
            shopId: document.getElementById('shopFilter').value
        };
    }

    // Initialize empty charts
    initializeEmptyCharts() {
        const emptyData = { labels: [], datasets: [] };
        
        this.charts.inventoryByCategory = this.createChart(
            'inventoryByCategoryChart',
            { type: 'doughnut', data: emptyData }
        );
        
        this.charts.salesCogs = this.createChart(
            'salesCogsChart',
            { type: 'bar', data: emptyData }
        );
        
        this.charts.stockMovement = this.createChart(
            'stockMovementChart',
            { type: 'bar', data: emptyData }
        );
        
        this.charts.purchasesExpenses = this.createChart(
            'purchasesExpensesChart',
            { type: 'line', data: emptyData }
        );
    }

    // Create a chart with safe initialization
    createChart(canvasId, config) {
        const ctx = document.getElementById(canvasId).getContext('2d');
        return new Chart(ctx, config);
    }

    // Destroy a chart safely
    destroyChart(chart) {
        if (chart && typeof chart.destroy === 'function') {
            chart.destroy();
        }
        return null;
    }

    // Load all dashboard data
    async loadData() {
        this.showLoadingState();
        
        try {
            const { startDate, endDate, shopId } = this.currentFilters;
            
            const [inventoryData, cogsData, stockMovementData, purchasesExpensesData, liabilitiesData] = await Promise.all([
                this.fetchData('getInventoryValuation', { shopId }),
                this.fetchData('getCOGSData', { startDate, endDate, shopId }),
                this.fetchData('getStockMovement', { startDate, endDate, shopId }),
                this.fetchData('getPurchasesExpenses', { startDate, endDate, shopId }),
                this.fetchData('getOutstandingLiabilities', { shopId })
            ]);
            
            this.updateKPIs(inventoryData, cogsData, liabilitiesData);
            this.updateCharts(inventoryData, cogsData, stockMovementData, purchasesExpensesData);
            this.updateTables(inventoryData);
            
        } catch (error) {
            console.error('Failed to load dashboard data:', error);
            this.showErrorState();
        }
    }

    // Generic data fetcher
    async fetchData(action, params) {
        const queryString = Object.entries(params)
            .filter(([_, value]) => value !== null && value !== undefined)
            .map(([key, value]) => `${key}=${value}`)
            .join('&');
            
        const response = await fetch(`api.php?action=${action}&${queryString}`);
        return await response.json();
    }

    // Show loading state
    showLoadingState() {
        document.querySelectorAll('.kpi-value').forEach(el => {
            el.textContent = '...';
        });
        
        document.querySelectorAll('.chart-container').forEach(el => {
            el.classList.add('loading');
        });
    }

    // Show error state
    showErrorState() {
        document.querySelectorAll('.kpi-value').forEach(el => {
            el.textContent = 'ERR';
            el.classList.add('text-danger');
        });
    }

    // Update KPI cards
    updateKPIs(inventoryData, cogsData, liabilitiesData) {
        // Total Inventory Value
        const totalInventoryValue = inventoryData.reduce((sum, item) => sum + (item.total_value || 0), 0);
        this.updateKPICard('totalInventoryValue', 
            `$${totalInventoryValue.toLocaleString('en-US', {maximumFractionDigits: 0})}`,
            totalInventoryValue > 0 ? 'positive' : '');

        // Gross Margin (average if multiple months)
        const avgGrossMargin = cogsData.length > 0 
            ? cogsData.reduce((sum, month) => sum + (month.gross_margin || 0), 0) / cogsData.length 
            : 0;
        this.updateKPICard('grossMargin', 
            `${avgGrossMargin.toFixed(1)}%`,
            avgGrossMargin >= 30 ? 'positive' : 'negative');

        // Stock Turnover (simplified calculation)
        const totalCOGS = cogsData.reduce((sum, month) => sum + (month.cogs || 0), 0);
        const avgInventory = totalInventoryValue / 2; // Simplified average inventory
        const stockTurnover = avgInventory > 0 ? totalCOGS / avgInventory : 0;
        this.updateKPICard('stockTurnover', 
            `${stockTurnover.toFixed(1)}x`,
            stockTurnover > 2 ? 'positive' : 'negative');

        // Outstanding Liabilities
        const liabilities = liabilitiesData.total_liabilities || 0;
        this.updateKPICard('outstandingLiabilities', 
            `$${liabilities.toLocaleString('en-US', {maximumFractionDigits: 0})}`,
            liabilities > 0 ? 'negative' : 'positive');
    }

    // Update individual KPI card
    updateKPICard(elementId, value, statusClass = '') {
        const element = document.getElementById(elementId);
        if (element) {
            element.textContent = value;
            element.className = `kpi-value ${statusClass}`;
        }
    }

    // Update all charts
    updateCharts(inventoryData, cogsData, stockMovementData, purchasesExpensesData) {
        this.updateInventoryByCategoryChart(inventoryData);
        this.updateSalesCogsChart(cogsData);
        this.updateStockMovementChart(stockMovementData);
        this.updatePurchasesExpensesChart(purchasesExpensesData);
    }

    // Update inventory by category chart
    updateInventoryByCategoryChart(data) {
        // Group by category
        const categories = {};
        data.forEach(item => {
            if (!item.category) return;
            if (!categories[item.category]) {
                categories[item.category] = 0;
            }
            categories[item.category] += item.total_value || 0;
        });
        
        this.charts.inventoryByCategory.data.labels = Object.keys(categories);
        this.charts.inventoryByCategory.data.datasets = [{
            data: Object.values(categories),
            backgroundColor: [
                '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', 
                '#9966FF', '#FF9F40', '#8AC24A', '#607D8B'
            ],
            borderWidth: 1
        }];
        this.charts.inventoryByCategory.update();
    }

    // Update sales vs COGS chart
    updateSalesCogsChart(data) {
        const months = data.map(item => item.month);
        const sales = data.map(item => item.revenue || 0);
        const cogs = data.map(item => item.cogs || 0);
        const grossProfit = data.map(item => item.gross_profit || 0);
        
        this.charts.salesCogs.data.labels = months;
        this.charts.salesCogs.data.datasets = [
            {
                label: 'Revenue',
                data: sales,
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            },
            {
                label: 'COGS',
                data: cogs,
                backgroundColor: 'rgba(255, 99, 132, 0.7)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            },
            {
                label: 'Gross Profit',
                data: grossProfit,
                type: 'line',
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.1)',
                borderWidth: 2,
                fill: true
            }
        ];
        this.charts.salesCogs.update();
    }

    // Update stock movement chart
    updateStockMovementChart(data) {
        const productNames = data.map(item => item.product_name || 'Unknown');
        const startingStock = data.map(item => item.starting_stock || 0);
        const stockIn = data.map(item => item.stock_in || 0);
        const stockOut = data.map(item => -(item.stock_out || 0)); // Negative for visual effect
        const endingStock = data.map(item => item.ending_stock || 0);
        
        this.charts.stockMovement.data.labels = productNames;
        this.charts.stockMovement.data.datasets = [
            {
                label: 'Starting Stock',
                data: startingStock,
                backgroundColor: 'rgba(201, 203, 207, 0.7)',
                borderColor: 'rgba(201, 203, 207, 1)',
                borderWidth: 1
            },
            {
                label: 'Stock In',
                data: stockIn,
                backgroundColor: 'rgba(75, 192, 192, 0.7)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            },
            {
                label: 'Stock Out',
                data: stockOut,
                backgroundColor: 'rgba(255, 99, 132, 0.7)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            },
            {
                label: 'Ending Stock',
                data: endingStock,
                type: 'line',
                borderColor: 'rgba(153, 102, 255, 1)',
                backgroundColor: 'rgba(153, 102, 255, 0.1)',
                borderWidth: 2,
                fill: false
            }
        ];
        this.charts.stockMovement.update();
    }

    // Update purchases vs expenses chart
    updatePurchasesExpensesChart(data) {
        const months = data.map(item => item.month);
        const purchases = data.map(item => item.total_purchases || 0);
        const expenses = data.map(item => item.total_expenses || 0);
        
        this.charts.purchasesExpenses.data.labels = months;
        this.charts.purchasesExpenses.data.datasets = [
            {
                label: 'Purchases',
                data: purchases,
                borderColor: 'rgba(54, 162, 235, 1)',
                backgroundColor: 'rgba(54, 162, 235, 0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            },
            {
                label: 'Expenses',
                data: expenses,
                borderColor: 'rgba(255, 99, 132, 1)',
                backgroundColor: 'rgba(255, 99, 132, 0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }
        ];
        this.charts.purchasesExpenses.update();
    }

    // Update data tables
    updateTables(inventoryData) {
        this.updateTopInventoryTable(inventoryData);
        this.updateLowStockTable(inventoryData);
    }

    // Update top inventory table
    updateTopInventoryTable(data) {
        // Sort by total value descending
        const sortedData = [...data].sort((a, b) => (b.total_value || 0) - (a.total_value || 0));
        const top10 = sortedData.slice(0, 10);
        
        const tableBody = document.querySelector('#topInventoryTable tbody');
        tableBody.innerHTML = '';
        
        top10.forEach(item => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${item.product_name || 'Unknown'}</td>
                <td>${(item.stock || 0).toFixed(2)}</td>
                <td>$${(item.unit_price || 0).toFixed(2)}</td>
                <td>$${(item.total_value || 0).toFixed(2)}</td>
            `;
            tableBody.appendChild(row);
        });
    }

    // Update low stock table
    updateLowStockTable(data) {
        // Filter items below minimum stock
        const lowStockItems = data.filter(item => 
            (item.stock || 0) < (item.stock_min || Infinity)
        );
        
        const tableBody = document.querySelector('#lowStockTable tbody');
        tableBody.innerHTML = '';
        
        lowStockItems.forEach(item => {
            const deficit = (item.stock_min || 0) - (item.stock || 0);
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${item.product_name || 'Unknown'}</td>
                <td class="${(item.stock || 0) < (item.stock_min || 0) ? 'text-danger fw-bold' : ''}">
                    ${(item.stock || 0).toFixed(2)}
                </td>
                <td>${(item.stock_min || 20).toFixed(2)}</td>
                <td class="text-danger fw-bold">${deficit.toFixed(2)}</td>
            `;
            tableBody.appendChild(row);
        });
    }
}

// Initialize the dashboard when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    const dashboard = new DashboardManager();
    dashboard.init();
});