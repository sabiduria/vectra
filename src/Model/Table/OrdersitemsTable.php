<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ordersitems Model
 *
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsTo $Products
 * @property \App\Model\Table\OrdersTable&\Cake\ORM\Association\BelongsTo $Orders
 *
 * @method \App\Model\Entity\Ordersitem newEmptyEntity()
 * @method \App\Model\Entity\Ordersitem newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Ordersitem> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ordersitem get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Ordersitem findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Ordersitem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Ordersitem> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ordersitem|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Ordersitem saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Ordersitem>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Ordersitem>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Ordersitem>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Ordersitem> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Ordersitem>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Ordersitem>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Ordersitem>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Ordersitem> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OrdersitemsTable extends Table
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

        $this->setTable('ordersitems');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Orders', [
            'foreignKey' => 'order_id',
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
            ->integer('product_id')
            ->notEmptyString('product_id');

        $validator
            ->integer('order_id')
            ->notEmptyString('order_id');

        $validator
            ->numeric('qty')
            ->allowEmptyString('qty');

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
            ->scalar('moodifiedby')
            ->maxLength('moodifiedby', 45)
            ->allowEmptyString('moodifiedby');

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
        $rules->add($rules->existsIn(['order_id'], 'Orders'), ['errorField' => 'order_id']);

        return $rules;
    }
}
