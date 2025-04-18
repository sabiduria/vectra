<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Spents Model
 *
 * @property \App\Model\Table\PurchasesTable&\Cake\ORM\Association\BelongsTo $Purchases
 * @property \App\Model\Table\SpenttypesTable&\Cake\ORM\Association\BelongsTo $Spenttypes
 *
 * @method \App\Model\Entity\Spent newEmptyEntity()
 * @method \App\Model\Entity\Spent newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Spent> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Spent get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Spent findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Spent patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Spent> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Spent|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Spent saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Spent>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Spent>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Spent>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Spent> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Spent>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Spent>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Spent>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Spent> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SpentsTable extends Table
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

        $this->setTable('spents');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Purchases', [
            'foreignKey' => 'purchase_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Spenttypes', [
            'foreignKey' => 'spenttype_id',
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
            ->integer('spenttype_id')
            ->notEmptyString('spenttype_id');

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
        $rules->add($rules->existsIn(['spenttype_id'], 'Spenttypes'), ['errorField' => 'spenttype_id']);

        return $rules;
    }
}
