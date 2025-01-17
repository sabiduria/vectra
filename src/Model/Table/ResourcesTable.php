<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Resources Model
 *
 * @property \App\Model\Table\AccessrightsTable&\Cake\ORM\Association\HasMany $Accessrights
 *
 * @method \App\Model\Entity\Resource newEmptyEntity()
 * @method \App\Model\Entity\Resource newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Resource> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Resource get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Resource findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Resource patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Resource> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Resource|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Resource saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Resource>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Resource>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Resource>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Resource> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Resource>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Resource>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Resource>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Resource> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ResourcesTable extends Table
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

        $this->setTable('resources');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Accessrights', [
            'foreignKey' => 'resource_id',
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
            ->scalar('generic_name')
            ->maxLength('generic_name', 45)
            ->allowEmptyString('generic_name');

        $validator
            ->scalar('icon')
            ->maxLength('icon', 45)
            ->allowEmptyString('icon');

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
