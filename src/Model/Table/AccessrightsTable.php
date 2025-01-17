<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Accessrights Model
 *
 * @property \App\Model\Table\ProfilesTable&\Cake\ORM\Association\BelongsTo $Profiles
 * @property \App\Model\Table\ResourcesTable&\Cake\ORM\Association\BelongsTo $Resources
 *
 * @method \App\Model\Entity\Accessright newEmptyEntity()
 * @method \App\Model\Entity\Accessright newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Accessright> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Accessright get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Accessright findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Accessright patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Accessright> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Accessright|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Accessright saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Accessright>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Accessright>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Accessright>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Accessright> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Accessright>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Accessright>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Accessright>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Accessright> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AccessrightsTable extends Table
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

        $this->setTable('accessrights');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Profiles', [
            'foreignKey' => 'profile_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Resources', [
            'foreignKey' => 'resource_id',
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
            ->integer('profile_id')
            ->notEmptyString('profile_id');

        $validator
            ->integer('resource_id')
            ->notEmptyString('resource_id');

        $validator
            ->boolean('c')
            ->allowEmptyString('c');

        $validator
            ->boolean('r')
            ->allowEmptyString('r');

        $validator
            ->boolean('u')
            ->allowEmptyString('u');

        $validator
            ->boolean('d')
            ->allowEmptyString('d');

        $validator
            ->boolean('p')
            ->allowEmptyString('p');

        $validator
            ->boolean('v')
            ->allowEmptyString('v');

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
        $rules->add($rules->existsIn(['profile_id'], 'Profiles'), ['errorField' => 'profile_id']);
        $rules->add($rules->existsIn(['resource_id'], 'Resources'), ['errorField' => 'resource_id']);

        return $rules;
    }
}
