<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Prospections Model
 *
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsTo $Products
 * @property \App\Model\Table\SuppliersTable&\Cake\ORM\Association\BelongsTo $Suppliers
 * @property \App\Model\Table\PackagingsTable&\Cake\ORM\Association\BelongsTo $Packagings
 *
 * @method \App\Model\Entity\Prospection newEmptyEntity()
 * @method \App\Model\Entity\Prospection newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Prospection> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Prospection get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Prospection findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Prospection patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Prospection> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Prospection|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Prospection saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Prospection>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Prospection>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Prospection>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Prospection> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Prospection>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Prospection>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Prospection>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Prospection> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProspectionsTable extends Table
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

        $this->setTable('prospections');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
        ]);
        $this->belongsTo('Suppliers', [
            'foreignKey' => 'supplier_id',
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
            ->integer('supplier_id')
            ->allowEmptyString('supplier_id');

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
        $rules->add($rules->existsIn(['supplier_id'], 'Suppliers'), ['errorField' => 'supplier_id']);
        $rules->add($rules->existsIn(['packaging_id'], 'Packagings'), ['errorField' => 'packaging_id']);

        return $rules;
    }
}
