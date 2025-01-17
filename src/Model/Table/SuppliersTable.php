<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Suppliers Model
 *
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\HasMany $Products
 * @property \App\Model\Table\PurchasesTable&\Cake\ORM\Association\HasMany $Purchases
 *
 * @method \App\Model\Entity\Supplier newEmptyEntity()
 * @method \App\Model\Entity\Supplier newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Supplier> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Supplier get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Supplier findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Supplier patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Supplier> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Supplier|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Supplier saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Supplier>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Supplier>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Supplier>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Supplier> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Supplier>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Supplier>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Supplier>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Supplier> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SuppliersTable extends Table
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

        $this->setTable('suppliers');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Products', [
            'foreignKey' => 'supplier_id',
        ]);
        $this->hasMany('Purchases', [
            'foreignKey' => 'supplier_id',
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
            ->scalar('address')
            ->maxLength('address', 45)
            ->allowEmptyString('address');

        $validator
            ->scalar('phone1')
            ->maxLength('phone1', 15)
            ->allowEmptyString('phone1');

        $validator
            ->scalar('phone2')
            ->maxLength('phone2', 15)
            ->allowEmptyString('phone2');

        $validator
            ->email('email')
            ->allowEmptyString('email');

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
