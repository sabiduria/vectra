<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Attendancestypes Model
 *
 * @property \App\Model\Table\AttendancesTable&\Cake\ORM\Association\HasMany $Attendances
 *
 * @method \App\Model\Entity\Attendancestype newEmptyEntity()
 * @method \App\Model\Entity\Attendancestype newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Attendancestype> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Attendancestype get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Attendancestype findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Attendancestype patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Attendancestype> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Attendancestype|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Attendancestype saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Attendancestype>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Attendancestype>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Attendancestype>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Attendancestype> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Attendancestype>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Attendancestype>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Attendancestype>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Attendancestype> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AttendancestypesTable extends Table
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

        $this->setTable('attendancestypes');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Attendances', [
            'foreignKey' => 'attendancestype_id',
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
            ->maxLength('name', 45)
            ->allowEmptyString('name');

        $validator
            ->numeric('penality')
            ->allowEmptyString('penality');

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
