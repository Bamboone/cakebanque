<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


/**
 * Virements Model
 *
 * @property \App\Model\Table\ComptesTable&\Cake\ORM\Association\BelongsTo $Comptes
 *
 * @method \App\Model\Entity\Virement get($primaryKey, $options = [])
 * @method \App\Model\Entity\Virement newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Virement[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Virement|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Virement saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Virement patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Virement[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Virement findOrCreate($search, callable $callback = null, $options = [])
 */
class VirementsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('virements');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Comptes', [
            'foreignKey' => 'compte_id'
        ]);

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->email('email')
            ->allowEmptyString('email');

        $validator
            ->numeric('montant')
            ->allowEmptyString('montant');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['compte_id'], 'Comptes'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
