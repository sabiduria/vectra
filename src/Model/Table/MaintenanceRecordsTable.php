<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MaintenanceRecords Model
 *
 * @property \App\Model\Table\EquipmentsTable&\Cake\ORM\Association\BelongsTo $Equipments
 * @property \App\Model\Table\MaintenanceTasksTable&\Cake\ORM\Association\HasMany $MaintenanceTasks
 * @property \App\Model\Table\PartsUsedsTable&\Cake\ORM\Association\HasMany $PartsUseds
 *
 * @method \App\Model\Entity\MaintenanceRecord newEmptyEntity()
 * @method \App\Model\Entity\MaintenanceRecord newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\MaintenanceRecord> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MaintenanceRecord get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\MaintenanceRecord findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\MaintenanceRecord patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\MaintenanceRecord> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\MaintenanceRecord|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\MaintenanceRecord saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\MaintenanceRecord>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MaintenanceRecord>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MaintenanceRecord>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MaintenanceRecord> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MaintenanceRecord>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MaintenanceRecord>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MaintenanceRecord>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MaintenanceRecord> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MaintenanceRecordsTable extends Table
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

        $this->setTable('maintenance_records');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Equipments', [
            'foreignKey' => 'equipment_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('MaintenanceTasks', [
            'foreignKey' => 'maintenance_record_id',
        ]);
        $this->hasMany('PartsUseds', [
            'foreignKey' => 'maintenance_record_id',
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
            ->scalar('maintenance_type')
            ->maxLength('maintenance_type', 45)
            ->allowEmptyString('maintenance_type');

        $validator
            ->integer('equipment_id')
            ->notEmptyString('equipment_id');

        $validator
            ->date('scheduled_date')
            ->allowEmptyDate('scheduled_date');

        $validator
            ->date('completion_date')
            ->allowEmptyDate('completion_date');

        $validator
            ->scalar('maintenance_status')
            ->maxLength('maintenance_status', 45)
            ->allowEmptyString('maintenance_status');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->scalar('findings')
            ->allowEmptyString('findings');

        $validator
            ->scalar('recommendations')
            ->allowEmptyString('recommendations');

        $validator
            ->numeric('cost')
            ->allowEmptyString('cost');

        $validator
            ->numeric('downtime_hours')
            ->allowEmptyString('downtime_hours');

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
        $rules->add($rules->existsIn(['equipment_id'], 'Equipments'), ['errorField' => 'equipment_id']);

        return $rules;
    }
}
