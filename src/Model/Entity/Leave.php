<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Leave Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $leavestype_id
 * @property int|null $status_id
 * @property \Cake\I18n\Date|null $startdate
 * @property \Cake\I18n\Date|null $enddate
 * @property string|null $reason
 * @property string|null $approvedby
 * @property \Cake\I18n\Date|null $approveddate
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 * @property string|null $createdby
 * @property string|null $modifiedby
 * @property bool|null $deleted
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Leavestype $leavestype
 * @property \App\Model\Entity\Status $status
 */
class Leave extends Entity
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
        'leavestype_id' => true,
        'status_id' => true,
        'startdate' => true,
        'enddate' => true,
        'reason' => true,
        'approvedby' => true,
        'approveddate' => true,
        'created' => true,
        'modified' => true,
        'createdby' => true,
        'modifiedby' => true,
        'deleted' => true,
        'user' => true,
        'leavestype' => true,
        'status' => true,
    ];
}
