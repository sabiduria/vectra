<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Transfersdetails Model
 *
 * @property \App\Model\Table\TransfersTable&\Cake\ORM\Association\BelongsTo $Transfers
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsTo $Products
 *
 * @method \App\Model\Entity\Transfersdetail newEmptyEntity()
 * @method \App\Model\Entity\Transfersdetail newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Transfersdetail> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Transfersdetail get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Transfersdetail findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Transfersdetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Transfersdetail> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Transfersdetail|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Transfersdetail saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Transfersdetail>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Transfersdetail>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Transfersdetail>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Transfersdetail> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Transfersdetail>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Transfersdetail>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Transfersdetail>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Transfersdetail> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TransfersdetailsTable extends Table
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

        $this->setTable('transfersdetails');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Transfers', [
            'foreignKey' => 'transfer_id',
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
            ->integer('transfer_id')
            ->notEmptyString('transfer_id');

        $validator
            ->integer('product_id')
            ->notEmptyString('product_id');

        $validator
            ->numeric('qty')
            ->allowEmptyString('qty');

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
        $rules->add($rules->existsIn(['transfer_id'], 'Transfers'), ['errorField' => 'transfer_id']);
        $rules->add($rules->existsIn(['product_id'], 'Products'), ['errorField' => 'product_id']);

        return $rules;
    }
}
