<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\I18n\DateTime;
use Cake\ORM\Query;
use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Categories Model
 *
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\HasMany $Products
 *
 * @method \App\Model\Entity\Category newEmptyEntity()
 * @method \App\Model\Entity\Category newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Category> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Category get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Category findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Category patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Category> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Category|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Category saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Category>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Category>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Category>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Category> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Category>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Category>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Category>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Category> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CategoriesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('categories');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Products', [
            'foreignKey' => 'category_id',
        ]);
    }

    public function findSalesStatistics(Query $query, array $options)
    {
        return $query
            ->select([
                'Categories.id',
                'Categories.name',
                'total_sales' => 'SUM(Salesitems.subtotal)',
                'total_quantity' => 'SUM(Salesitems.qty)',
                'avg_price' => 'AVG(Salesitems.unit_price)',
                'product_count' => 'COUNT(DISTINCT Products.id)',
                'order_count' => 'COUNT(DISTINCT Sales.id)'
            ])
            ->leftJoinWith('Products.Salesitems.Sales')
            ->group('Categories.id')
            ->where([
                'Sales.created >=' => $options['start_date'] ?? new DateTime('-1 month'),
                'Sales.created <=' => $options['end_date'] ?? new DateTime('now'),
                'Sales.deleted' => 0
            ]);
    }

    public function findMonthlyTrend(Query $query, array $options)
    {
        return $query
            ->select([
                'category_name' => 'Categories.name',
                'year_months' => 'DATE_FORMAT(Sales.created, "%Y-%m")',
                'monthly_sales' => 'SUM(Salesitems.subtotal)',
                'monthly_quantity' => 'SUM(Salesitems.qty)'
            ])
            ->leftJoinWith('Products.Salesitems.Sales')
            ->group(['Categories.id', 'year_months'])
            ->where([
                'Sales.created >=' => $options['start_date'] ?? new DateTime('-12 months'),
                'Sales.created <=' => $options['end_date'] ?? new DateTime('now'),
                'Sales.deleted' => 0
            ])
            ->order(['year_months' => 'ASC', 'monthly_sales' => 'DESC']);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('name')
            ->maxLength('name', 45)
            ->allowEmptyString('name');

        $validator
            ->scalar('createdby')
            ->maxLength('createdby', 45)
            ->allowEmptyString('createdby');

        $validator
            ->scalar('modifiedby')
            ->maxLength('modifiedby', 45)
            ->allowEmptyString('modifiedby');

        $validator
            ->boolean('deleted')
            ->allowEmptyString('deleted');

        return $validator;
    }
}
