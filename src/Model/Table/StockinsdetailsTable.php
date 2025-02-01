<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Stockinsdetails Model
 *
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsTo $Products
 * @property \App\Model\Table\StockinsTable&\Cake\ORM\Association\BelongsTo $Stockins
 *
 * @method \App\Model\Entity\Stockinsdetail newEmptyEntity()
 * @method \App\Model\Entity\Stockinsdetail newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Stockinsdetail> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Stockinsdetail get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Stockinsdetail findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Stockinsdetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Stockinsdetail> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Stockinsdetail|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Stockinsdetail saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Stockinsdetail>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Stockinsdetail>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Stockinsdetail>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Stockinsdetail> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Stockinsdetail>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Stockinsdetail>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Stockinsdetail>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Stockinsdetail> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class StockinsdetailsTable extends Table
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

        $this->setTable('stockinsdetails');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Stockins', [
            'foreignKey' => 'stockin_id',
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
            ->integer('product_id')
            ->notEmptyString('product_id');

        $validator
            ->integer('stockin_id')
            ->notEmptyString('stockin_id');

        $validator
            ->integer('room_id')
            ->allowEmptyString('room_id');

        $validator
            ->numeric('purchase_price')
            ->allowEmptyString('purchase_price');

        $validator
            ->scalar('barcode')
            ->maxLength('barcode', 45)
            ->allowEmptyString('barcode');

        $validator
            ->numeric('qty')
            ->allowEmptyString('qty');

        $validator
            ->date('expiry_date')
            ->allowEmptyDate('expiry_date');

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
        $rules->add($rules->existsIn(['stockin_id'], 'Stockins'), ['errorField' => 'stockin_id']);
        $rules->add($rules->existsIn(['room_id'], 'Rooms'), ['errorField' => 'room_id']);

        return $rules;
    }
}
