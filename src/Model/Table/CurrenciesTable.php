<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Currencies Model
 *
 * @method \App\Model\Entity\Currency newEmptyEntity()
 * @method \App\Model\Entity\Currency newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Currency> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Currency get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Currency findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Currency patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Currency> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Currency|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Currency saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Currency>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Currency>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Currency>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Currency> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Currency>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Currency>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Currency>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Currency> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CurrenciesTable extends Table
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

        $this->setTable('currencies');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->scalar('short_name')
            ->maxLength('short_name', 4)
            ->allowEmptyString('short_name');

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
