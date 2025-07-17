<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Equipments Model
 *
 * @property \App\Model\Table\FuelLevelsTable&\Cake\ORM\Association\HasMany $FuelLevels
 * @property \App\Model\Table\MaintenanceRecordsTable&\Cake\ORM\Association\HasMany $MaintenanceRecords
 *
 * @method \App\Model\Entity\Equipment newEmptyEntity()
 * @method \App\Model\Entity\Equipment newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Equipment> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Equipment get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Equipment findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Equipment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Equipment> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Equipment|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Equipment saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Equipment>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Equipment>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Equipment>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Equipment> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Equipment>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Equipment>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Equipment>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Equipment> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EquipmentsTable extends Table
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

        $this->setTable('equipments');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('FuelLevels', [
            'foreignKey' => 'equipment_id',
        ]);
        $this->hasMany('MaintenanceRecords', [
            'foreignKey' => 'equipment_id',
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
            ->scalar('name')
            ->maxLength('name', 100)
            ->allowEmptyString('name');

        $validator
            ->scalar('serial_number')
            ->maxLength('serial_number', 45)
            ->allowEmptyString('serial_number');

        $validator
            ->scalar('equipment_model')
            ->maxLength('equipment_model', 45)
            ->allowEmptyString('equipment_model');

        $validator
            ->scalar('manufacturer')
            ->maxLength('manufacturer', 45)
            ->allowEmptyString('manufacturer');

        $validator
            ->date('purchase_date')
            ->allowEmptyDate('purchase_date');

        $validator
            ->date('warranty_expiration')
            ->allowEmptyDate('warranty_expiration');

        $validator
            ->scalar('equipment_status')
            ->maxLength('equipment_status', 45)
            ->allowEmptyString('equipment_status');

        $validator
            ->date('last_maintenance_date')
            ->allowEmptyDate('last_maintenance_date');

        $validator
            ->date('next_maintenance_date')
            ->allowEmptyDate('next_maintenance_date');

        $validator
            ->integer('maintenance_frequency')
            ->allowEmptyString('maintenance_frequency');

        $validator
            ->numeric('maximum_fuel')
            ->allowEmptyString('maximum_fuel');

        $validator
            ->boolean('tracked_fuel')
            ->allowEmptyString('tracked_fuel');

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
}
