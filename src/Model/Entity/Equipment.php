<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Equipment Entity
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $serial_number
 * @property string|null $equipment_model
 * @property string|null $manufacturer
 * @property \Cake\I18n\Date|null $purchase_date
 * @property \Cake\I18n\Date|null $warranty_expiration
 * @property string|null $equipment_status
 * @property \Cake\I18n\Date|null $last_maintenance_date
 * @property \Cake\I18n\Date|null $next_maintenance_date
 * @property int|null $maintenance_frequency
 * @property float|null $maximum_fuel
 * @property bool|null $tracked_fuel
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 * @property string|null $createdby
 * @property string|null $modifiedby
 * @property bool|null $deleted
 *
 * @property \App\Model\Entity\FuelLevel[] $fuel_levels
 * @property \App\Model\Entity\MaintenanceRecord[] $maintenance_records
 */
class Equipment extends Entity
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
        'name' => true,
        'serial_number' => true,
        'equipment_model' => true,
        'manufacturer' => true,
        'purchase_date' => true,
        'warranty_expiration' => true,
        'equipment_status' => true,
        'last_maintenance_date' => true,
        'next_maintenance_date' => true,
        'maintenance_frequency' => true,
        'maximum_fuel' => true,
        'tracked_fuel' => true,
        'created' => true,
        'modified' => true,
        'createdby' => true,
        'modifiedby' => true,
        'deleted' => true,
        'fuel_levels' => true,
        'maintenance_records' => true,
    ];
}
