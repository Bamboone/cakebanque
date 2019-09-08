<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Compte Entity
 *
 * @property int $id
 * @property string $type_compte
 * @property \Cake\I18n\FrozenDate $date
 * @property string|null $image
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $user_id
 *
 * @property \App\Model\Entity\User[] $users
 */
class Compte extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'type_compte' => true,
        'date' => true,
        'image' => true,
        'created' => true,
        'modified' => true,
        'user_id' => true,
        'users' => true
    ];
}
