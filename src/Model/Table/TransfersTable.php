<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Transfers Model
 *
 * @property \App\Model\Table\ShopsTable&\Cake\ORM\Association\BelongsTo $Shops
 * @property \App\Model\Table\TransfersdetailsTable&\Cake\ORM\Association\HasMany $Transfersdetails
 *
 * @method \App\Model\Entity\Transfer newEmptyEntity()
 * @method \App\Model\Entity\Transfer newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Transfer> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Transfer get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Transfer findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Transfer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Transfer> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Transfer|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Transfer saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Transfer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Transfer>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Transfer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Transfer> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Transfer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Transfer>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Transfer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Transfer> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TransfersTable extends Table
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

        $this->setTable('transfers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Shops', [
            'foreignKey' => 'shop_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Transfersdetails', [
            'foreignKey' => 'transfer_id',
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
            ->scalar('reference')
            ->maxLength('reference', 15)
            ->allowEmptyString('reference');

        $validator
            ->integer('shop_id')
            ->notEmptyString('shop_id');

        $validator
            ->integer('receiver_id')
            ->allowEmptyString('receiver_id');

        $validator
            ->scalar('reason')
            ->allowEmptyString('reason');

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
        $rules->add($rules->existsIn(['shop_id'], 'Shops'), ['errorField' => 'shop_id']);

        return $rules;
    }
}
