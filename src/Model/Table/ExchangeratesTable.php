<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Exchangerates Model
 *
 * @method \App\Model\Entity\Exchangerate newEmptyEntity()
 * @method \App\Model\Entity\Exchangerate newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Exchangerate> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Exchangerate get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Exchangerate findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Exchangerate patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Exchangerate> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Exchangerate|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Exchangerate saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Exchangerate>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Exchangerate>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Exchangerate>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Exchangerate> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Exchangerate>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Exchangerate>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Exchangerate>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Exchangerate> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ExchangeratesTable extends Table
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

        $this->setTable('exchangerates');
        $this->setDisplayField('id');
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
            ->integer('currency_from')
            ->allowEmptyString('currency_from');

        $validator
            ->integer('currency_to')
            ->allowEmptyString('currency_to');

        $validator
            ->numeric('rates')
            ->allowEmptyString('rates');

        $validator
            ->boolean('isactived')
            ->allowEmptyString('isactived');

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
