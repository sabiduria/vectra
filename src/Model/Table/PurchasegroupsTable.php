<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Purchasegroups Model
 *
 * @method \App\Model\Entity\Purchasegroup newEmptyEntity()
 * @method \App\Model\Entity\Purchasegroup newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Purchasegroup> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Purchasegroup get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Purchasegroup findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Purchasegroup patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Purchasegroup> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Purchasegroup|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Purchasegroup saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Purchasegroup>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Purchasegroup>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Purchasegroup>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Purchasegroup> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Purchasegroup>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Purchasegroup>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Purchasegroup>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Purchasegroup> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PurchasegroupsTable extends Table
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

        $this->setTable('purchasegroups');
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
            ->scalar('reference')
            ->maxLength('reference', 15)
            ->allowEmptyString('reference');

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
