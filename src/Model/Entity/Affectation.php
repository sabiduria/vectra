<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Affectation Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $profile_id
 * @property int $shop_id
 * @property bool|null $isactived
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 * @property string|null $createdby
 * @property string|null $modifiedby
 * @property bool|null $deleted
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Profile $profile
 * @property \App\Model\Entity\Shop $shop
 * @property \App\Model\Entity\Attendance[] $attendances
 */
class Affectation extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'user_id' => true,
        'profile_id' => true,
        'shop_id' => true,
        'isactived' => true,
        'created' => true,
        'modified' => true,
        'createdby' => true,
        'modifiedby' => true,
        'deleted' => true,
        'user' => true,
        'profile' => true,
        'shop' => true,
        'attendances' => true,
    ];
}
