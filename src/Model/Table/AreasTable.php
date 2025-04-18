<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Areas Model
 *
 * @property \App\Model\Table\ShopsTable&\Cake\ORM\Association\HasMany $Shops
 *
 * @method \App\Model\Entity\Area newEmptyEntity()
 * @method \App\Model\Entity\Area newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Area> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Area get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Area findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Area patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Area> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Area|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Area saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Area>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Area>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Area>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Area> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Area>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Area>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Area>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Area> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AreasTable extends Table
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

        $this->setTable('areas');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Shops', [
            'foreignKey' => 'area_id',
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
