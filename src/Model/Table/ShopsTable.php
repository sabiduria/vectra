<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Shops Model
 *
 * @property \App\Model\Table\AreasTable&\Cake\ORM\Association\BelongsTo $Areas
 * @property \App\Model\Table\AffectationsTable&\Cake\ORM\Association\HasMany $Affectations
 * @property \App\Model\Table\ExpensesTable&\Cake\ORM\Association\HasMany $Expenses
 * @property \App\Model\Table\ShopstocksTable&\Cake\ORM\Association\HasMany $Shopstocks
 * @property \App\Model\Table\StockinsTable&\Cake\ORM\Association\HasMany $Stockins
 * @property \App\Model\Table\TransfersTable&\Cake\ORM\Association\HasMany $Transfers
 *
 * @method \App\Model\Entity\Shop newEmptyEntity()
 * @method \App\Model\Entity\Shop newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Shop> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Shop get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Shop findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Shop patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Shop> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Shop|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Shop saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Shop>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Shop>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Shop>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Shop> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Shop>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Shop>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Shop>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Shop> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ShopsTable extends Table
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

        $this->setTable('shops');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Areas', [
            'foreignKey' => 'area_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Affectations', [
            'foreignKey' => 'shop_id',
        ]);
        $this->hasMany('Expenses', [
            'foreignKey' => 'shop_id',
        ]);
        $this->hasMany('Shopstocks', [
            'foreignKey' => 'shop_id',
        ]);
        $this->hasMany('Stockins', [
            'foreignKey' => 'shop_id',
        ]);
        $this->hasMany('Transfers', [
            'foreignKey' => 'shop_id',
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
            ->integer('area_id')
            ->notEmptyString('area_id');

        $validator
            ->scalar('name')
            ->maxLength('name', 45)
            ->allowEmptyString('name');

        $validator
            ->scalar('address')
            ->maxLength('address', 45)
            ->allowEmptyString('address');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 45)
            ->allowEmptyString('phone');

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
        $rules->add($rules->existsIn(['area_id'], 'Areas'), ['errorField' => 'area_id']);

        return $rules;
    }
}
