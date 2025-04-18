<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Spenttypes Model
 *
 * @property \App\Model\Table\SpentsTable&\Cake\ORM\Association\HasMany $Spents
 *
 * @method \App\Model\Entity\Spenttype newEmptyEntity()
 * @method \App\Model\Entity\Spenttype newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Spenttype> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Spenttype get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Spenttype findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Spenttype patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Spenttype> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Spenttype|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Spenttype saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Spenttype>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Spenttype>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Spenttype>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Spenttype> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Spenttype>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Spenttype>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Spenttype>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Spenttype> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SpenttypesTable extends Table
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

        $this->setTable('spenttypes');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Spents', [
            'foreignKey' => 'spenttype_id',
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
