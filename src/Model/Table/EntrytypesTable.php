<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Entrytypes Model
 *
 * @property \App\Model\Table\StockinsTable&\Cake\ORM\Association\HasMany $Stockins
 *
 * @method \App\Model\Entity\Entrytype newEmptyEntity()
 * @method \App\Model\Entity\Entrytype newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Entrytype> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Entrytype get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Entrytype findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Entrytype patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Entrytype> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Entrytype|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Entrytype saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Entrytype>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Entrytype>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Entrytype>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Entrytype> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Entrytype>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Entrytype>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Entrytype>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Entrytype> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EntrytypesTable extends Table
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

        $this->setTable('entrytypes');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Stockins', [
            'foreignKey' => 'entrytype_id',
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
