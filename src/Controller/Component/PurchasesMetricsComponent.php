<?php
namespace App\Controller\Component;

use Cake\Cache\Cache;
use Cake\Controller\Component;
use Cake\I18n\Date;
use Cake\I18n\FrozenDate;
use Cake\Log\Log;
use Cake\ORM\TableRegistry;
use Exception;

class PurchasesMetricsComponent extends Component
{
    protected $Purchases;
    protected $PurchasesItems;
    protected $Suppliers;
    protected $Products;

    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->Purchases = TableRegistry::getTableLocator()->get('Purchases');
        $this->PurchasesItems = TableRegistry::getTableLocator()->get('PurchasesItems');
        $this->Suppliers = TableRegistry::getTableLocator()->get('Suppliers');
        $this->Products = TableRegistry::getTableLocator()->get('Products');
    }

    public function getSupplierPerformance(string $timeRange = 'last_12_months'): array
    {
        try {
            $query = $this->Purchases->find()
                ->contain(['Suppliers'])
                ->select([
                    'supplier_name' => 'Suppliers.name', // Fixed typo from 'Suppliers.name'
                    'supplier_id' => 'Suppliers.id',
                    'total_spend' => $this->Purchases->query()->func()->sum('Purchases.total_amount'),
                    'avg_delivery_days' => $this->Purchases->query()->func()->avg(
                        $this->Purchases->query()->func()->datediff([
                            'Purchases.receipt_date' => 'literal',
                            'Purchases.created' => 'literal'
                        ])
                    ),
                    'order_count' => $this->Purchases->query()->func()->count('Purchases.id')
                ])
                ->where([
                    'Purchases.deleted' => 0,
                    'Suppliers.deleted' => 0,
                    'Purchases.receipt_date IS NOT NULL'
                ])
                ->group('Purchases.supplier_id')
                ->order(['total_spend' => 'DESC'])
                ->enableHydration(false); // This makes it return arrays

            $this->applyTimeFilter($query, $timeRange);

            return $query->toArray();

        } catch (Exception $e) {
            Log::error('Supplier performance query failed: ' . $e->getMessage());
            return [];
        }
    }

    public function getMonthlyProcurementTrends()
    {
        return $this->Purchases->find()
            ->select([
                'year' => 'YEAR(Purchases.created)',
                'month' => 'MONTH(Purchases.created)',
                'total_spend' => 'SUM(Purchases.total_amount)',
                'item_count' => 'SUM(PurchasesItems.qty)'
            ])
            ->join([
                'PurchasesItems' => [
                    'table' => 'purchasesitems',
                    'type' => 'LEFT',
                    'conditions' => 'PurchasesItems.purchase_id = Purchases.id'
                ]
            ])
            ->group(['YEAR(Purchases.created)', 'MONTH(Purchases.created)'])
            ->order(['year' => 'DESC', 'month' => 'DESC'])
            ->limit(12)
            ->toArray();
    }

    public function getPriceVarianceAnalysis()
    {
        return $this->PurchasesItems->find()
            ->contain(['Products', 'Purchases.Suppliers'])
            ->select([
                'Products.name',
                'Suppliers.name',
                'avg_price' => $this->PurchasesItems->query()->func()->avg('PurchasesItems.price'),
                'min_price' => $this->PurchasesItems->query()->func()->min('PurchasesItems.price'),
                'max_price' => $this->PurchasesItems->query()->func()->max('PurchasesItems.price'),
                'price_variance' => $this->PurchasesItems->query()->newExpr('STDDEV(PurchasesItems.price)'),
            ])
            ->group(['PurchasesItems.product_id', 'Purchases.supplier_id'])
            ->having(['price_variance >' => 0])
            ->order(['price_variance' => 'DESC'])
            ->limit(10)
            ->toArray();
    }

    public function getCategoryWiseSpend()
    {
        try {
            return Cache::remember('category_spend', function () {
                return $this->PurchasesItems->find()
                    ->contain([
                        'Products' => function ($q) {
                            return $q->contain(['Categories']);
                        }
                    ])
                    ->select([
                        'category_name' => 'Categories.name',
                        'total_spend' => $this->PurchasesItems->query()->func()->sum(
                            $this->PurchasesItems->query()->newExpr()
                                ->add('PurchasesItems.price * PurchasesItems.qty')
                        )
                    ])
                    ->where([
                        'PurchasesItems.deleted' => 0,
                        'Products.deleted' => 0,
                        'Categories.deleted' => 0
                    ])
                    ->group('Categories.id')
                    ->order(['total_spend' => 'DESC'])
                    ->toArray();
            }, 'long_term');

        } catch (Exception $e) {
            Log::error('Category spend query failed: ' . $e->getMessage());
            return [];
        }
    }

    public function getDeliveryPerformance()
    {
        return $this->Purchases->find()
            ->select(function ($query) {
                return [
                    'supplier_name' => 'Suppliers.name',
                    'total_orders' => $query->func()->count('*'),
                    'on_time_orders' => $query->newExpr('SUM(CASE WHEN Purchases.receipt_date <= Purchases.due_date THEN 1 ELSE 0 END)'),
                    'late_orders' => $query->newExpr('SUM(CASE WHEN Purchases.receipt_date > Purchases.due_date THEN 1 ELSE 0 END)'),
                    'on_time_percentage' => $query->newExpr('ROUND(SUM(CASE WHEN Purchases.receipt_date <= Purchases.due_date THEN 1 ELSE 0 END) * 100.0 / COUNT(*), 2)'),
                    'avg_delay_days' => $query->newExpr('AVG(DATEDIFF(Purchases.receipt_date, Purchases.due_date))')
                ];
            })
            ->contain(['Suppliers'])
            ->where([
                'Purchases.receipt_date IS NOT NULL',
                'Purchases.due_date IS NOT NULL',
                'Purchases.deleted' => 0,
                'Suppliers.deleted' => 0
            ])
            ->group('Purchases.supplier_id')
            ->order(['on_time_percentage' => 'DESC'])
            ->enableHydration(false)
            ->toArray();
    }

    public function getTopProcuredProducts($limit = 10, $timeRange = 'last_12_months')
    {
        // Initialize required tables
        $this->Products = TableRegistry::getTableLocator()->get('Products');
        $this->PurchasesItems = TableRegistry::getTableLocator()->get('PurchasesItems');
        $this->Purchases = TableRegistry::getTableLocator()->get('Purchases');

        $query = $this->PurchasesItems->find()
            ->contain([
                'Products',
                'Purchases' => function ($q) use ($timeRange) {
                    return $q->where($this->getTimeRangeConditions($timeRange));
                }
            ])
            ->select([
                'product_id' => 'Products.id',
                'product_name' => 'Products.name',
                'product_reference' => 'Products.reference',
                'total_quantity' => $this->PurchasesItems->query()->func()->sum('PurchasesItems.qty'),
                'total_spend' => $this->PurchasesItems->query()->func()->sum(
                    $this->PurchasesItems->query()->newExpr('PurchasesItems.qty * PurchasesItems.price')
                ),
                'avg_price' => $this->PurchasesItems->query()->func()->avg('PurchasesItems.price'),
                'supplier_count' => $this->PurchasesItems->query()->func()->count('DISTINCT Purchases.supplier_id')
            ])
            ->where([
                'Products.deleted' => 0,
                'Purchases.deleted' => 0,
                'PurchasesItems.deleted' => 0
            ])
            ->group(['PurchasesItems.product_id'])
            ->order(['total_quantity' => 'DESC'])
            ->limit($limit);

        return $query->all();
    }

    private function getTimeRangeConditions($timeRange)
    {
        $now = new Date(); // Or FrozenDate
        $conditions = [];

        switch ($timeRange) {
            case 'last_month':
                $lastMonth = $now->subMonths(1);
                $conditions['Purchases.created >='] = $lastMonth->firstOfMonth();
                $conditions['Purchases.created <='] = $lastMonth->lastOfMonth();
                break;

            case 'last_quarter':
                $start = $now->subMonths(3)->firstOfMonth();
                $end = $now->subMonths(1)->lastOfMonth();
                $conditions['Purchases.created >='] = $start;
                $conditions['Purchases.created <='] = $end;
                break;

            case 'last_year':
                $lastYear = $now->subMonths(12);
                $conditions['Purchases.created >='] = $lastYear;
                $conditions['Purchases.created <='] = $now;
                break;

            case 'current_year':
                $conditions['Purchases.created >='] = $now->firstOfYear();
                $conditions['Purchases.created <='] = $now;
                break;

            default: // last_12_months
                $conditions['Purchases.created >='] = $now->subMonths(12);
                $conditions['Purchases.created <='] = $now;
                break;
        }

        return $conditions;
    }

    public function getYearOverYearGrowth()
    {
        $currentYear = (new FrozenDate())->year;
        $previousYear = $currentYear - 1;

        $results = $this->Purchases->find()
            ->select([
                'year' => 'YEAR(Purchases.created)',
                'total_spend' => 'SUM(Purchases.total_amount)'
            ])
            ->where([
                'YEAR(Purchases.created) IN' => [$previousYear, $currentYear],
                'Purchases.deleted' => 0
            ])
            ->group(['YEAR(Purchases.created)'])
            ->order(['year' => 'DESC'])
            ->enableHydration(false)
            ->toArray();

        // Initialize default values
        $currentYearSpend = 0;
        $previousYearSpend = 0;
        $growthPercent = 0;

        // Extract values from query results
        foreach ($results as $result) {
            if ($result['year'] == $currentYear) {
                $currentYearSpend = (float)$result['total_spend'];
            } elseif ($result['year'] == $previousYear) {
                $previousYearSpend = (float)$result['total_spend'];
            }
        }

        // Safe growth calculation
        if ($previousYearSpend > 0) {
            $growthPercent = ($currentYearSpend - $previousYearSpend) / $previousYearSpend * 100;
        } elseif ($currentYearSpend > 0) {
            // Handle case where previous year had no spending (infinite growth)
            $growthPercent = 100;
        }

        return [
            'current_year' => $currentYearSpend,
            'previous_year' => $previousYearSpend,
            'growth_percent' => round($growthPercent, 2),
        ];
    }

    private function applyTimeFilter($query, string $timeRange)
    {
        $now = new FrozenDate();

        switch($timeRange) {
            case 'last_month':
                $query->where([
                    'Purchases.created >=' => $now->subMonth()->firstOfMonth(),
                    'Purchases.created <=' => $now->subMonth()->lastOfMonth()
                ]);
                break;

            case 'last_quarter':
                $query->where([
                    'Purchases.created >=' => $now->subMonths(3)->firstOfMonth(),
                    'Purchases.created <=' => $now->subMonth()->lastOfMonth()
                ]);
                break;

            default: // last_12_months
                $query->where(['Purchases.created >=' => $now->subYears(1)]);
                break;
        }
    }
}
