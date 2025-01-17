<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Auditlogs Model
 *
 * @method \App\Model\Entity\Auditlog newEmptyEntity()
 * @method \App\Model\Entity\Auditlog newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Auditlog> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Auditlog get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Auditlog findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Auditlog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Auditlog> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Auditlog|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Auditlog saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Auditlog>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Auditlog>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Auditlog>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Auditlog> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Auditlog>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Auditlog>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Auditlog>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Auditlog> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AuditlogsTable extends Table
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

        $this->setTable('auditlogs');
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
            ->scalar('event_type')
            ->maxLength('event_type', 100)
            ->allowEmptyString('event_type');

        $validator
            ->scalar('event_description')
            ->allowEmptyString('event_description');

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
