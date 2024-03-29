<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


/**
 * Comptes Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsToMany $Users
 *
 * @method \App\Model\Entity\Compte get($primaryKey, $options = [])
 * @method \App\Model\Entity\Compte newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Compte[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Compte|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Compte saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Compte patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Compte[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Compte findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ComptesTable extends Table
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

        $this->setTable('comptes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Translate', ['fields' => ['nom', 'type_compte'], 'allowEmptyTranslations' =>false]);

        $this->belongsToMany('Users', [
            'foreignKey' => 'compte_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'users_comptes'
        ]);

        $this->belongsTo('Files', [
            'foreignKey' => 'file_id'
        ]);

        $this->belongsTo('Institutions', [
            'foreignKey' => 'institution_id'
        ]);


        $this->hasMany('Transactions', [
            'foreignKey' => 'compte_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);

        $this->hasMany('Virements', [
            'foreignKey' => 'compte_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
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
            ->integer('institution_id')
            ->requirePresence('institution_id', 'create');

        $validator
            ->scalar('type_compte')
            ->maxLength('type_compte', 255)
            ->requirePresence('type_compte', 'create')
            ->notEmptyString('type_compte');

        $validator
            ->scalar('nom')
            ->maxLength('nom', 255)
            ->requirePresence('nom', 'create')
            ->notEmptyString('nom');

        $validator
            ->scalar('image')
            ->maxLength('image', 255)
            ->allowEmptyFile('image');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }

}
