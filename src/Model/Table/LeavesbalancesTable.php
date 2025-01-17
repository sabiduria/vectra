<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Leavesbalances Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\LeavestypesTable&\Cake\ORM\Association\BelongsTo $Leavestypes
 *
 * @method \App\Model\Entity\Leavesbalance newEmptyEntity()
 * @method \App\Model\Entity\Leavesbalance newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Leavesbalance> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Leavesbalance get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Leavesbalance findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Leavesbalance patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Leavesbalance> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Leavesbalance|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Leavesbalance saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Leavesbalance>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Leavesbalance>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Leavesbalance>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Leavesbalance> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Leavesbalance>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Leavesbalance>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Leavesbalance>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Leavesbalance> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LeavesbalancesTable extends Table
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

        $this->setTable('leavesbalances');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Leavestypes', [
            'foreignKey' => 'leavestype_id',
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
            ->integer('user_id')
            ->notEmptyString('user_id');

        $validator
            ->integer('leavestype_id')
            ->notEmptyString('leavestype_id');

        $validator
            ->numeric('available_balance')
            ->allowEmptyString('available_balance');

        $validator
            ->numeric('balance_year')
            ->allowEmptyString('balance_year');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn(['leavestype_id'], 'Leavestypes'), ['errorField' => 'leavestype_id']);

        return $rules;
    }
}
