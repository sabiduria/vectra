<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Expensestypes Model
 *
 * @property \App\Model\Table\ExpensesTable&\Cake\ORM\Association\HasMany $Expenses
 *
 * @method \App\Model\Entity\Expensestype newEmptyEntity()
 * @method \App\Model\Entity\Expensestype newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Expensestype> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Expensestype get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Expensestype findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Expensestype patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Expensestype> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Expensestype|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Expensestype saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Expensestype>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Expensestype>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Expensestype>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Expensestype> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Expensestype>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Expensestype>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Expensestype>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Expensestype> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ExpensestypesTable extends Table
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

        $this->setTable('expensestypes');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Expenses', [
            'foreignKey' => 'expensestype_id',
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
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->numeric('monthy_amount')
            ->allowEmptyString('monthy_amount');

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
