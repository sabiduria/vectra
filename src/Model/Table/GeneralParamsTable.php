<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * GeneralParams Model
 *
 * @method \App\Model\Entity\GeneralParam newEmptyEntity()
 * @method \App\Model\Entity\GeneralParam newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\GeneralParam> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\GeneralParam get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\GeneralParam findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\GeneralParam patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\GeneralParam> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\GeneralParam|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\GeneralParam saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\GeneralParam>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\GeneralParam>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\GeneralParam>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\GeneralParam> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\GeneralParam>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\GeneralParam>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\GeneralParam>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\GeneralParam> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class GeneralParamsTable extends Table
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

        $this->setTable('general_params');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->scalar('rccm')
            ->maxLength('rccm', 100)
            ->allowEmptyString('rccm');

        $validator
            ->scalar('idnat')
            ->maxLength('idnat', 45)
            ->allowEmptyString('idnat');

        $validator
            ->scalar('impot')
            ->maxLength('impot', 45)
            ->allowEmptyString('impot');

        $validator
            ->scalar('printer_name')
            ->maxLength('printer_name', 45)
            ->allowEmptyString('printer_name');

        $validator
            ->scalar('printer_ip')
            ->maxLength('printer_ip', 45)
            ->allowEmptyString('printer_ip');

        $validator
            ->numeric('growth')
            ->allowEmptyString('growth');

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
