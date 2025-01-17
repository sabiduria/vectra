<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Stockins Model
 *
 * @property \App\Model\Table\ShopsTable&\Cake\ORM\Association\BelongsTo $Shops
 * @property \App\Model\Table\StockinsdetailsTable&\Cake\ORM\Association\HasMany $Stockinsdetails
 *
 * @method \App\Model\Entity\Stockin newEmptyEntity()
 * @method \App\Model\Entity\Stockin newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Stockin> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Stockin get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Stockin findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Stockin patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Stockin> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Stockin|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Stockin saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Stockin>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Stockin>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Stockin>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Stockin> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Stockin>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Stockin>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Stockin>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Stockin> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class StockinsTable extends Table
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

        $this->setTable('stockins');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Shops', [
            'foreignKey' => 'shop_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Stockinsdetails', [
            'foreignKey' => 'stockin_id',
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
            ->integer('shop_id')
            ->notEmptyString('shop_id');

        $validator
            ->scalar('reference')
            ->maxLength('reference', 45)
            ->allowEmptyString('reference');

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
