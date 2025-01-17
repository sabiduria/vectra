<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Profiles Model
 *
 * @property \App\Model\Table\AccessrightsTable&\Cake\ORM\Association\HasMany $Accessrights
 * @property \App\Model\Table\AffectationsTable&\Cake\ORM\Association\HasMany $Affectations
 *
 * @method \App\Model\Entity\Profile newEmptyEntity()
 * @method \App\Model\Entity\Profile newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Profile> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Profile get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Profile findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Profile patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Profile> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Profile|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Profile saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Profile>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Profile>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Profile>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Profile> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Profile>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Profile>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Profile>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Profile> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProfilesTable extends Table
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

        $this->setTable('profiles');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Accessrights', [
            'foreignKey' => 'profile_id',
        ]);
        $this->hasMany('Affectations', [
            'foreignKey' => 'profile_id',
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
