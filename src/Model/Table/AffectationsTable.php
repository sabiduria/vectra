<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Affectations Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\ProfilesTable&\Cake\ORM\Association\BelongsTo $Profiles
 * @property \App\Model\Table\ShopsTable&\Cake\ORM\Association\BelongsTo $Shops
 * @property \App\Model\Table\AttendancesTable&\Cake\ORM\Association\HasMany $Attendances
 *
 * @method \App\Model\Entity\Affectation newEmptyEntity()
 * @method \App\Model\Entity\Affectation newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Affectation> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Affectation get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Affectation findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Affectation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Affectation> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Affectation|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Affectation saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Affectation>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Affectation>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Affectation>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Affectation> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Affectation>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Affectation>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Affectation>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Affectation> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AffectationsTable extends Table
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

        $this->setTable('affectations');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Profiles', [
            'foreignKey' => 'profile_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Shops', [
            'foreignKey' => 'shop_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Attendances', [
            'foreignKey' => 'affectation_id',
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
            ->integer('user_id')
            ->notEmptyString('user_id');

        $validator
            ->integer('profile_id')
            ->notEmptyString('profile_id');

        $validator
            ->integer('shop_id')
            ->notEmptyString('shop_id');

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

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn(['profile_id'], 'Profiles'), ['errorField' => 'profile_id']);
        $rules->add($rules->existsIn(['shop_id'], 'Shops'), ['errorField' => 'shop_id']);

        return $rules;
    }
}
