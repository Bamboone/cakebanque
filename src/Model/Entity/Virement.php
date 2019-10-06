<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Virement Entity
 *
 * @property int $id
 * @property string|null $email
 * @property float|null $montant
 * @property int|null $compte_id
 *
 * @property \App\Model\Entity\Compte $compte
 */
class Virement extends Entity
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
        'email' => true,
        'montant' => true,
        'compte_id' => true,
        'compte' => true,
        'user_id' => true,
        'user' => true,
    ];
}
