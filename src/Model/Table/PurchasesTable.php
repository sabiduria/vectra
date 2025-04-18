<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Purchases Model
 *
 * @property \App\Model\Table\StatusesTable&\Cake\ORM\Association\BelongsTo $Statuses
 * @property \App\Model\Table\SuppliersTable&\Cake\ORM\Association\BelongsTo $Suppliers
 * @property \App\Model\Table\PaymentstosuppliersTable&\Cake\ORM\Association\HasMany $Paymentstosuppliers
 * @property \App\Model\Table\PurchasesitemsTable&\Cake\ORM\Association\HasMany $Purchasesitems
 *
 * @method \App\Model\Entity\Purchase newEmptyEntity()
 * @method \App\Model\Entity\Purchase newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Purchase> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Purchase get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Purchase findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Purchase patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Purchase> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Purchase|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Purchase saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Purchase>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Purchase>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Purchase>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Purchase> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Purchase>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Purchase>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Purchase>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Purchase> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PurchasesTable extends Table
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

        $this->setTable('purchases');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Statuses', [
            'foreignKey' => 'status_id',
        ]);
        $this->belongsTo('Suppliers', [
            'foreignKey' => 'supplier_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Paymentstosuppliers', [
            'foreignKey' => 'purchase_id',
        ]);
        $this->hasMany('Purchasesitems', [
            'foreignKey' => 'purchase_id',
        ]);
        $this->hasMany('Spents', [
            'foreignKey' => 'purchase_id',
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
            ->integer('status_id')
            ->allowEmptyString('status_id');

        $validator
            ->integer('supplier_id')
            ->notEmptyString('supplier_id');

        $validator
            ->scalar('reference')
            ->maxLength('reference', 15)
            ->allowEmptyString('reference');

        $validator
            ->date('due_date')
            ->allowEmptyDate('due_date');

        $validator
            ->dateTime('receipt_date')
            ->allowEmptyDateTime('receipt_date');

        $validator
            ->scalar('purchase_group_reference')
            ->maxLength('purchase_group_reference', 15)
            ->allowEmptyString('purchase_group_reference');

        $validator
            ->numeric('total_amount')
            ->allowEmptyString('total_amount');

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
        $rules->add($rules->existsIn(['status_id'], 'Statuses'), ['errorField' => 'status_id']);
        $rules->add($rules->existsIn(['supplier_id'], 'Suppliers'), ['errorField' => 'supplier_id']);

        return $rules;
    }
}
