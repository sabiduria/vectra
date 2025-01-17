<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Leaves Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\LeavestypesTable&\Cake\ORM\Association\BelongsTo $Leavestypes
 * @property \App\Model\Table\StatusesTable&\Cake\ORM\Association\BelongsTo $Statuses
 *
 * @method \App\Model\Entity\Leave newEmptyEntity()
 * @method \App\Model\Entity\Leave newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Leave> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Leave get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Leave findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Leave patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Leave> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Leave|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Leave saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Leave>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Leave>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Leave>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Leave> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Leave>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Leave>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Leave>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Leave> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LeavesTable extends Table
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

        $this->setTable('leaves');
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
        $this->belongsTo('Statuses', [
            'foreignKey' => 'status_id',
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
            ->integer('status_id')
            ->allowEmptyString('status_id');

        $validator
            ->date('startdate')
            ->allowEmptyDate('startdate');

        $validator
            ->date('enddate')
            ->allowEmptyDate('enddate');

        $validator
            ->scalar('reason')
            ->allowEmptyString('reason');

        $validator
            ->scalar('approvedby')
            ->maxLength('approvedby', 45)
            ->allowEmptyString('approvedby');

        $validator
            ->date('approveddate')
            ->allowEmptyDate('approveddate');

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
        $rules->add($rules->existsIn(['status_id'], 'Statuses'), ['errorField' => 'status_id']);

        return $rules;
    }
}
