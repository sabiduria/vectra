<?php

namespace App\Service;

use Cake\I18n\FrozenDate;
use Cake\ORM\TableRegistry;

class SalesAnalyticsService
{
    public function getSalesSummary(array $options = [])
    {
        $salesTable = TableRegistry::getTableLocator()->get('Sales');

        $query = $salesTable->find()
            ->select([
                'total_sales' => 'COUNT(Sales.id)',
                'total_revenue' => 'SUM(Sales.total_amount)',
                'total_customers' => 'COUNT(DISTINCT Sales.customer_id)',
                'avg_order_value' => 'AVG(Sales.total_amount)'
            ]);

        if (!empty($options['start_date'])) {
            $query->where(['Sales.created >=' => $options['start_date']]);
        }

        if (!empty($options['end_date'])) {
            $query->where(['Sales.created <=' => $options['end_date']]);
        }

        if (!empty($options['shop_id'])) {
            $query->where(['Sales.shop_id' => $options['shop_id']]);
        }

        return $query->first();
    }

    public function getSalesTrend(string $period = 'monthly', array $options = [])
    {
        $salesTable = TableRegistry::getTableLocator()->get('Sales');

        $format = $period === 'daily' ? '%Y-%m-%d' : '%Y-%m';
        $group = $period === 'daily' ? 'DATE(Sales.created)' : 'YEAR(Sales.created), MONTH(Sales.created)';

        $query = $salesTable->find()
            ->select([
                'period' => "DATE_FORMAT(Sales.created, '{$format}')",
                'total_sales' => 'COUNT(Sales.id)',
                'total_revenue' => 'SUM(Sales.total_amount)',
                'total_customers' => 'COUNT(DISTINCT Sales.customer_id)'
            ])
            ->group($group)
            ->order(['period' => 'ASC']);

        if (!empty($options['start_date'])) {
            $query->where(['Sales.created >=' => $options['start_date']]);
        }

        if (!empty($options['end_date'])) {
            $query->where(['Sales.created <=' => $options['end_date']]);
        }

        if (!empty($options['shop_id'])) {
            $query->where(['Sales.shop_id' => $options['shop_id']]);
        }

        return $query->toArray();
    }

    public function getTopProducts(int $limit = 5, array $options = [])
    {
        $salesItemsTable = TableRegistry::getTableLocator()->get('SalesItems');

        $query = $salesItemsTable->find()
            ->contain(['Products'])
            ->select([
                'product_name' => 'Products.name',
                'total_quantity' => 'SUM(SalesItems.qty)',
                'total_revenue' => 'SUM(SalesItems.subtotal)'
            ])
            ->group(['SalesItems.product_id'])
            ->order(['total_revenue' => 'DESC'])
            ->limit($limit);

        if (!empty($options['start_date'])) {
            $query->matching('Sales', function ($q) use ($options) {
                return $q->where(['Sales.created >=' => $options['start_date']]);
            });
        }

        if (!empty($options['end_date'])) {
            $query->matching('Sales', function ($q) use ($options) {
                return $q->where(['Sales.created <=' => $options['end_date']]);
            });
        }

        if (!empty($options['shop_id'])) {
            $query->matching('Sales', function ($q) use ($options) {
                return $q->where(['Sales.shop_id' => $options['shop_id']]);
            });
        }

        return $query->toArray();
    }

    public function getCustomerMetrics(array $options = [])
    {
        $customersTable = TableRegistry::getTableLocator()->get('Customers');
        $salesTable = TableRegistry::getTableLocator()->get('Sales');

        // New vs Returning Customers
        $newCustomers = $customersTable->find()
            ->where(['created >=' => FrozenDate::now()->subMonths(3)])
            ->count();

        $returningCustomers = $salesTable->find()
            ->select(['customer_id'])
            ->where(['created >=' => FrozenDate::now()->subMonths(3)])
            ->group(['customer_id'])
            ->having(['COUNT(customer_id) >' => 1])
            ->count();

        // Customer Lifetime Value
        $clv = $salesTable->find()
            ->select([
                'avg_value' => 'AVG(total_amount)',
                'avg_frequency' => 'COUNT(Sales.id) / COUNT(DISTINCT customer_id)'
            ])
            ->where(['created >=' => FrozenDate::now()->subYears(1)])
            ->first();

        return [
            'new_customers' => $newCustomers,
            'returning_customers' => $returningCustomers,
            'avg_clv' => $clv->avg_value * $clv->avg_frequency
        ];
    }
}
