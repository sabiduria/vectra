<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MarketProspections Model
 *
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsTo $Products
 * @property \App\Model\Table\PackagingsTable&\Cake\ORM\Association\BelongsTo $Packagings
 *
 * @method \App\Model\Entity\MarketProspection newEmptyEntity()
 * @method \App\Model\Entity\MarketProspection newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\MarketProspection> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MarketProspection get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\MarketProspection findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\MarketProspection patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\MarketProspection> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\MarketProspection|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\MarketProspection saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\MarketProspection>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MarketProspection>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MarketProspection>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MarketProspection> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MarketProspection>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MarketProspection>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MarketProspection>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MarketProspection> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MarketProspectionsTable extends Table
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

        $this->setTable('market_prospections');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
        ]);
        $this->belongsTo('Packagings', [
            'foreignKey' => 'packaging_id',
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
            ->integer('product_id')
            ->allowEmptyString('product_id');

        $validator
            ->scalar('vendor')
            ->maxLength('vendor', 100)
            ->allowEmptyString('vendor');

        $validator
            ->integer('packaging_id')
            ->allowEmptyString('packaging_id');

        $validator
            ->numeric('price')
            ->allowEmptyString('price');

        $validator
            ->scalar('comments')
            ->allowEmptyString('comments');

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
        $rules->add($rules->existsIn(['product_id'], 'Products'), ['errorField' => 'product_id']);
        $rules->add($rules->existsIn(['packaging_id'], 'Packagings'), ['errorField' => 'packaging_id']);

        return $rules;
    }
}
