<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Salaries Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\PayrollsTable&\Cake\ORM\Association\HasMany $Payrolls
 *
 * @method \App\Model\Entity\Salary newEmptyEntity()
 * @method \App\Model\Entity\Salary newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Salary> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Salary get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Salary findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Salary patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Salary> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Salary|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Salary saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Salary>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Salary>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Salary>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Salary> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Salary>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Salary>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Salary>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Salary> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SalariesTable extends Table
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

        $this->setTable('salaries');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Payrolls', [
            'foreignKey' => 'salary_id',
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
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
