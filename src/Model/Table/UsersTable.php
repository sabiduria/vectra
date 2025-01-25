<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\AffectationsTable&\Cake\ORM\Association\HasMany $Affectations
 * @property \App\Model\Table\LeavesTable&\Cake\ORM\Association\HasMany $Leaves
 * @property \App\Model\Table\LeavesbalancesTable&\Cake\ORM\Association\HasMany $Leavesbalances
 * @property \App\Model\Table\SalariesTable&\Cake\ORM\Association\HasMany $Salaries
 * @property \App\Model\Table\SalesTable&\Cake\ORM\Association\HasMany $Sales
 *
 * @method \App\Model\Entity\User newEmptyEntity()
 * @method \App\Model\Entity\User newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\User> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\User findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\User> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\User>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\User>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\User>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\User> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\User>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\User>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\User>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\User> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Affectations', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Leaves', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Leavesbalances', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Salaries', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Sales', [
            'foreignKey' => 'user_id',
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
            ->scalar('firstname')
            ->maxLength('firstname', 45)
            ->allowEmptyString('firstname');

        $validator
            ->scalar('lastname')
            ->maxLength('lastname', 45)
            ->allowEmptyString('lastname');

        $validator
            ->scalar('address')
            ->maxLength('address', 100)
            ->allowEmptyString('address');

        $validator
            ->scalar('phone1')
            ->maxLength('phone1', 15)
            ->allowEmptyString('phone1');

        $validator
            ->scalar('phone2')
            ->maxLength('phone2', 15)
            ->allowEmptyString('phone2');

        $validator
            ->numeric('leave_days_month')
            ->allowEmptyString('leave_days_month');

        $validator
            ->scalar('employeetype')
            ->maxLength('employeetype', 45)
            ->allowEmptyString('employeetype');

        $validator
            ->scalar('username')
            ->maxLength('username', 45)
            ->allowEmptyString('username');

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->allowEmptyString('password');

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
        $rules->add($rules->isUnique(['username']), ['errorField' => 'username']);

        return $rules;
    }
}
