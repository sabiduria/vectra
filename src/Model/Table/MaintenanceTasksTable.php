<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MaintenanceTasks Model
 *
 * @property \App\Model\Table\MaintenanceRecordsTable&\Cake\ORM\Association\BelongsTo $MaintenanceRecords
 *
 * @method \App\Model\Entity\MaintenanceTask newEmptyEntity()
 * @method \App\Model\Entity\MaintenanceTask newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\MaintenanceTask> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MaintenanceTask get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\MaintenanceTask findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\MaintenanceTask patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\MaintenanceTask> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\MaintenanceTask|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\MaintenanceTask saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\MaintenanceTask>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MaintenanceTask>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MaintenanceTask>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MaintenanceTask> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MaintenanceTask>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MaintenanceTask>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MaintenanceTask>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MaintenanceTask> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MaintenanceTasksTable extends Table
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

        $this->setTable('maintenance_tasks');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('MaintenanceRecords', [
            'foreignKey' => 'maintenance_record_id',
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
            ->integer('maintenance_record_id')
            ->notEmptyString('maintenance_record_id');

        $validator
            ->scalar('task_description')
            ->allowEmptyString('task_description');

        $validator
            ->scalar('tasks_status')
            ->maxLength('tasks_status', 45)
            ->allowEmptyString('tasks_status');

        $validator
            ->scalar('notes')
            ->allowEmptyString('notes');

        $validator
            ->numeric('hours_spent')
            ->allowEmptyString('hours_spent');

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
        $rules->add($rules->existsIn(['maintenance_record_id'], 'MaintenanceRecords'), ['errorField' => 'maintenance_record_id']);

        return $rules;
    }
}
