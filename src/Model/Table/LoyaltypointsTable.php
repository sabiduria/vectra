<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Loyaltypoints Model
 *
 * @property \App\Model\Table\CustomersTable&\Cake\ORM\Association\BelongsTo $Customers
 *
 * @method \App\Model\Entity\Loyaltypoint newEmptyEntity()
 * @method \App\Model\Entity\Loyaltypoint newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Loyaltypoint> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Loyaltypoint get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Loyaltypoint findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Loyaltypoint patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Loyaltypoint> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Loyaltypoint|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Loyaltypoint saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Loyaltypoint>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Loyaltypoint>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Loyaltypoint>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Loyaltypoint> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Loyaltypoint>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Loyaltypoint>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Loyaltypoint>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Loyaltypoint> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LoyaltypointsTable extends Table
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

        $this->setTable('loyaltypoints');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id',
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
            ->integer('customer_id')
            ->notEmptyString('customer_id');

        $validator
            ->integer('issuedpoints')
            ->allowEmptyString('issuedpoints');

        $validator
            ->integer('redeemedpoints')
            ->allowEmptyString('redeemedpoints');

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
        $rules->add($rules->existsIn(['customer_id'], 'Customers'), ['errorField' => 'customer_id']);

        return $rules;
    }
}
