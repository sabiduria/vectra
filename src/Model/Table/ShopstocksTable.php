<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Shopstocks Model
 *
 * @property \App\Model\Table\ShopsTable&\Cake\ORM\Association\BelongsTo $Shops
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsTo $Products
 * @property \App\Model\Table\RoomsTable&\Cake\ORM\Association\BelongsTo $Rooms
 *
 * @method \App\Model\Entity\Shopstock newEmptyEntity()
 * @method \App\Model\Entity\Shopstock newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Shopstock> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Shopstock get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Shopstock findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Shopstock patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Shopstock> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Shopstock|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Shopstock saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Shopstock>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Shopstock>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Shopstock>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Shopstock> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Shopstock>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Shopstock>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Shopstock>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Shopstock> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ShopstocksTable extends Table
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

        $this->setTable('shopstocks');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Shops', [
            'foreignKey' => 'shop_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Rooms', [
            'foreignKey' => 'room_id',
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
            ->integer('shop_id')
            ->notEmptyString('shop_id');

        $validator
            ->integer('product_id')
            ->notEmptyString('product_id');

        $validator
            ->integer('room_id')
            ->allowEmptyString('room_id');

        $validator
            ->numeric('stock')
            ->allowEmptyString('stock');

        $validator
            ->numeric('stock_min')
            ->allowEmptyString('stock_min');

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
        $rules->add($rules->existsIn(['shop_id'], 'Shops'), ['errorField' => 'shop_id']);
        $rules->add($rules->existsIn(['product_id'], 'Products'), ['errorField' => 'product_id']);
        $rules->add($rules->existsIn(['room_id'], 'Rooms'), ['errorField' => 'room_id']);

        return $rules;
    }
}
