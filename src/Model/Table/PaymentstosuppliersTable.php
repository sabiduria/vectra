<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Paymentstosuppliers Model
 *
 * @property \App\Model\Table\PurchasesTable&\Cake\ORM\Association\BelongsTo $Purchases
 *
 * @method \App\Model\Entity\Paymentstosupplier newEmptyEntity()
 * @method \App\Model\Entity\Paymentstosupplier newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Paymentstosupplier> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Paymentstosupplier get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Paymentstosupplier findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Paymentstosupplier patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Paymentstosupplier> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Paymentstosupplier|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Paymentstosupplier saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Paymentstosupplier>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Paymentstosupplier>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Paymentstosupplier>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Paymentstosupplier> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Paymentstosupplier>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Paymentstosupplier>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Paymentstosupplier>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Paymentstosupplier> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PaymentstosuppliersTable extends Table
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

        $this->setTable('paymentstosuppliers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Purchases', [
            'foreignKey' => 'purchase_id',
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
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->numeric('amount')
            ->allowEmptyString('amount');

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

        return $rules;
    }
}
