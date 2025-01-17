<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Salesitems Model
 *
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsTo $Products
 * @property \App\Model\Table\SalesTable&\Cake\ORM\Association\BelongsTo $Sales
 * @property \App\Model\Table\PackagingsTable&\Cake\ORM\Association\BelongsTo $Packagings
 *
 * @method \App\Model\Entity\Salesitem newEmptyEntity()
 * @method \App\Model\Entity\Salesitem newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Salesitem> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Salesitem get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Salesitem findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Salesitem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Salesitem> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Salesitem|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Salesitem saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Salesitem>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Salesitem>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Salesitem>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Salesitem> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Salesitem>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Salesitem>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Salesitem>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Salesitem> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SalesitemsTable extends Table
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

        $this->setTable('salesitems');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Sales', [
            'foreignKey' => 'sale_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Packagings', [
            'foreignKey' => 'packaging_id',
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
            ->integer('product_id')
            ->notEmptyString('product_id');

        $validator
            ->integer('sale_id')
            ->notEmptyString('sale_id');

        $validator
            ->numeric('qty')
            ->allowEmptyString('qty');

        $validator
            ->integer('packaging_id')
            ->allowEmptyString('packaging_id');

        $validator
            ->numeric('unit_price')
            ->allowEmptyString('unit_price');

        $validator
            ->numeric('subtotal')
            ->allowEmptyString('subtotal');

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
        $rules->add($rules->existsIn(['product_id'], 'Products'), ['errorField' => 'product_id']);
        $rules->add($rules->existsIn(['sale_id'], 'Sales'), ['errorField' => 'sale_id']);
        $rules->add($rules->existsIn(['packaging_id'], 'Packagings'), ['errorField' => 'packaging_id']);

        return $rules;
    }
}
