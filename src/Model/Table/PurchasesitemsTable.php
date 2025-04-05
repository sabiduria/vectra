<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Purchasesitems Model
 *
 * @property \App\Model\Table\PurchasesTable&\Cake\ORM\Association\BelongsTo $Purchases
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsTo $Products
 *
 * @method \App\Model\Entity\Purchasesitem newEmptyEntity()
 * @method \App\Model\Entity\Purchasesitem newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Purchasesitem> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Purchasesitem get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Purchasesitem findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Purchasesitem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Purchasesitem> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Purchasesitem|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Purchasesitem saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Purchasesitem>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Purchasesitem>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Purchasesitem>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Purchasesitem> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Purchasesitem>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Purchasesitem>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Purchasesitem>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Purchasesitem> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PurchasesitemsTable extends Table
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

        $this->setTable('purchasesitems');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Purchases', [
            'foreignKey' => 'purchase_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER',
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
            ->integer('purchase_id')
            ->notEmptyString('purchase_id');

        $validator
            ->integer('product_id')
            ->notEmptyString('product_id');

        $validator
            ->numeric('qty')
            ->allowEmptyString('qty');

        $validator
            ->numeric('price')
            ->allowEmptyString('price');

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
        $rules->add($rules->existsIn(['purchase_id'], 'Purchases'), ['errorField' => 'purchase_id']);
        $rules->add($rules->existsIn(['product_id'], 'Products'), ['errorField' => 'product_id']);

        return $rules;
    }
}
