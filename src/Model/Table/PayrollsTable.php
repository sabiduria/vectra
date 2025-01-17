<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Payrolls Model
 *
 * @property \App\Model\Table\SalariesTable&\Cake\ORM\Association\BelongsTo $Salaries
 *
 * @method \App\Model\Entity\Payroll newEmptyEntity()
 * @method \App\Model\Entity\Payroll newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Payroll> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Payroll get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Payroll findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Payroll patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Payroll> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Payroll|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Payroll saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Payroll>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Payroll>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Payroll>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Payroll> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Payroll>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Payroll>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Payroll>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Payroll> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PayrollsTable extends Table
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

        $this->setTable('payrolls');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Salaries', [
            'foreignKey' => 'salary_id',
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
            ->integer('salary_id')
            ->notEmptyString('salary_id');

        $validator
            ->date('period_start')
            ->allowEmptyDate('period_start');

        $validator
            ->date('period_end')
            ->allowEmptyDate('period_end');

        $validator
            ->numeric('period_salary')
            ->allowEmptyString('period_salary');

        $validator
            ->numeric('salary_payed')
            ->allowEmptyString('salary_payed');

        $validator
            ->numeric('deductions')
            ->allowEmptyString('deductions');

        $validator
            ->numeric('bonus')
            ->allowEmptyString('bonus');

        $validator
            ->boolean('totally_payed')
            ->allowEmptyString('totally_payed');

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
        $rules->add($rules->existsIn(['salary_id'], 'Salaries'), ['errorField' => 'salary_id']);

        return $rules;
    }
}
