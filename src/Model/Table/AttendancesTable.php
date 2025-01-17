<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Attendances Model
 *
 * @property \App\Model\Table\AffectationsTable&\Cake\ORM\Association\BelongsTo $Affectations
 * @property \App\Model\Table\AttendancestypesTable&\Cake\ORM\Association\BelongsTo $Attendancestypes
 *
 * @method \App\Model\Entity\Attendance newEmptyEntity()
 * @method \App\Model\Entity\Attendance newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Attendance> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Attendance get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Attendance findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Attendance patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Attendance> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Attendance|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Attendance saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Attendance>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Attendance>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Attendance>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Attendance> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Attendance>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Attendance>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Attendance>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Attendance> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AttendancesTable extends Table
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

        $this->setTable('attendances');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Affectations', [
            'foreignKey' => 'affectation_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Attendancestypes', [
            'foreignKey' => 'attendancestype_id',
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
            ->integer('affectation_id')
            ->notEmptyString('affectation_id');

        $validator
            ->integer('attendancestype_id')
            ->notEmptyString('attendancestype_id');

        $validator
            ->dateTime('check_in')
            ->allowEmptyDateTime('check_in');

        $validator
            ->dateTime('check_out')
            ->allowEmptyDateTime('check_out');

        $validator
            ->scalar('notes')
            ->allowEmptyString('notes');

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
        $rules->add($rules->existsIn(['affectation_id'], 'Affectations'), ['errorField' => 'affectation_id']);
        $rules->add($rules->existsIn(['attendancestype_id'], 'Attendancestypes'), ['errorField' => 'attendancestype_id']);

        return $rules;
    }
}
