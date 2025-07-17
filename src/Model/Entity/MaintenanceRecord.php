<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MaintenanceRecord Entity
 *
 * @property int $id
 * @property string|null $maintenance_type
 * @property int $equipment_id
 * @property \Cake\I18n\Date|null $scheduled_date
 * @property \Cake\I18n\Date|null $completion_date
 * @property string|null $maintenance_status
 * @property string|null $description
 * @property string|null $findings
 * @property string|null $recommendations
 * @property float|null $cost
 * @property float|null $downtime_hours
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 * @property string|null $createdby
 * @property string|null $modifiedby
 * @property bool|null $deleted
 *
 * @property \App\Model\Entity\Equipment $equipment
 * @property \App\Model\Entity\MaintenanceTask[] $maintenance_tasks
 * @property \App\Model\Entity\PartsUsed[] $parts_useds
 */
class MaintenanceRecord extends Entity
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
        'maintenance_type' => true,
        'equipment_id' => true,
        'scheduled_date' => true,
        'completion_date' => true,
        'maintenance_status' => true,
        'description' => true,
        'findings' => true,
        'recommendations' => true,
        'cost' => true,
        'downtime_hours' => true,
        'created' => true,
        'modified' => true,
        'createdby' => true,
        'modifiedby' => true,
        'deleted' => true,
        'equipment' => true,
        'maintenance_tasks' => true,
        'parts_useds' => true,
    ];
}
