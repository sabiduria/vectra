<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Products Model
 *
 * @property \App\Model\Table\SuppliersTable&\Cake\ORM\Association\BelongsTo $Suppliers
 * @property \App\Model\Table\CategoriesTable&\Cake\ORM\Association\BelongsTo $Categories
 * @property \App\Model\Table\PackagingsTable&\Cake\ORM\Association\BelongsTo $Packagings
 * @property \App\Model\Table\InventoriesTable&\Cake\ORM\Association\HasMany $Inventories
 * @property \App\Model\Table\OrdersitemsTable&\Cake\ORM\Association\HasMany $Ordersitems
 * @property \App\Model\Table\PricingsTable&\Cake\ORM\Association\HasMany $Pricings
 * @property \App\Model\Table\PromotionsproductsTable&\Cake\ORM\Association\HasMany $Promotionsproducts
 * @property \App\Model\Table\PurchasesitemsTable&\Cake\ORM\Association\HasMany $Purchasesitems
 * @property \App\Model\Table\SalesitemsTable&\Cake\ORM\Association\HasMany $Salesitems
 * @property \App\Model\Table\ShopstocksTable&\Cake\ORM\Association\HasMany $Shopstocks
 * @property \App\Model\Table\SpoilagesTable&\Cake\ORM\Association\HasMany $Spoilages
 * @property \App\Model\Table\StockinsdetailsTable&\Cake\ORM\Association\HasMany $Stockinsdetails
 * @property \App\Model\Table\TransfersdetailsTable&\Cake\ORM\Association\HasMany $Transfersdetails
 *
 * @method \App\Model\Entity\Product newEmptyEntity()
 * @method \App\Model\Entity\Product newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Product> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Product get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Product findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Product patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Product> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Product|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Product saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Product>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Product>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Product>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Product> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Product>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Product>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Product>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Product> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProductsTable extends Table
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

        $this->setTable('products');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Suppliers', [
            'foreignKey' => 'supplier_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Packagings', [
            'foreignKey' => 'packaging_id',
        ]);
        $this->hasMany('Inventories', [
            'foreignKey' => 'product_id',
        ]);
        $this->hasMany('Ordersitems', [
            'foreignKey' => 'product_id',
        ]);
        $this->hasMany('Pricings', [
            'foreignKey' => 'product_id',
        ]);
        $this->hasMany('Promotionsproducts', [
            'foreignKey' => 'product_id',
        ]);
        $this->hasMany('Purchasesitems', [
            'foreignKey' => 'product_id',
        ]);
        $this->hasMany('Salesitems', [
            'foreignKey' => 'product_id',
        ]);
        $this->hasMany('Shopstocks', [
            'foreignKey' => 'product_id',
        ]);
        $this->hasMany('Spoilages', [
            'foreignKey' => 'product_id',
        ]);
        $this->hasMany('Stockinsdetails', [
            'foreignKey' => 'product_id',
        ]);
        $this->hasMany('Transfersdetails', [
            'foreignKey' => 'product_id',
        ]);
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
            ->scalar('image')
            ->maxLength('image', 45)
            ->allowEmptyFile('image');

        $validator
            ->integer('supplier_id')
            ->notEmptyString('supplier_id');

        $validator
            ->integer('category_id')
            ->notEmptyString('category_id');

        $validator
            ->scalar('reference')
            ->maxLength('reference', 45)
            ->allowEmptyString('reference');

        $validator
            ->scalar('barcode')
            ->maxLength('barcode', 45)
            ->allowEmptyString('barcode');

        $validator
            ->scalar('name')
            ->maxLength('name', 45)
            ->allowEmptyString('name');

        $validator
            ->scalar('specifications')
            ->allowEmptyString('specifications');

        $validator
            ->scalar('notes')
            ->allowEmptyString('notes');

        $validator
            ->integer('packaging_id')
            ->allowEmptyString('packaging_id');

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

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['supplier_id'], 'Suppliers'), ['errorField' => 'supplier_id']);
        $rules->add($rules->existsIn(['category_id'], 'Categories'), ['errorField' => 'category_id']);
        $rules->add($rules->existsIn(['packaging_id'], 'Packagings'), ['errorField' => 'packaging_id']);

        return $rules;
    }
}
