<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Attendance Entity
 *
 * @property int $id
 * @property int $affectation_id
 * @property int $attendancestype_id
 * @property \Cake\I18n\DateTime|null $check_in
 * @property \Cake\I18n\DateTime|null $check_out
 * @property string|null $notes
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 * @property string|null $createdby
 * @property string|null $modifiedby
 * @property bool|null $deleted
 *
 * @property \App\Model\Entity\Affectation $affectation
 * @property \App\Model\Entity\Attendancestype $attendancestype
 */
class Attendance extends Entity
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
        'affectation_id' => true,
        'attendancestype_id' => true,
        'check_in' => true,
        'check_out' => true,
        'notes' => true,
        'created' => true,
        'modified' => true,
        'createdby' => true,
        'modifiedby' => true,
        'deleted' => true,
        'affectation' => true,
        'attendancestype' => true,
    ];
}
