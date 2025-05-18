<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Packagings Model
 *
 * @property \App\Model\Table\PricingsTable&\Cake\ORM\Association\HasMany $Pricings
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\HasMany $Products
 * @property \App\Model\Table\SalesitemsTable&\Cake\ORM\Association\HasMany $Salesitems
 *
 * @method \App\Model\Entity\Packaging newEmptyEntity()
 * @method \App\Model\Entity\Packaging newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Packaging> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Packaging get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Packaging findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Packaging patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Packaging> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Packaging|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Packaging saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Packaging>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Packaging>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Packaging>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Packaging> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Packaging>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Packaging>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Packaging>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Packaging> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PackagingsTable extends Table
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

        $this->setTable('packagings');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('MarketProspections', [
            'foreignKey' => 'packaging_id',
        ]);
        $this->hasMany('Pricings', [
            'foreignKey' => 'packaging_id',
        ]);
        $this->hasMany('Products', [
            'foreignKey' => 'packaging_id',
        ]);
        $this->hasMany('Prospections', [
            'foreignKey' => 'packaging_id',
        ]);
        $this->hasMany('Salesitems', [
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
            ->scalar('name')
            ->maxLength('name', 45)
            ->allowEmptyString('name');

        $validator
            ->numeric('weight')
            ->allowEmptyString('weight');

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
