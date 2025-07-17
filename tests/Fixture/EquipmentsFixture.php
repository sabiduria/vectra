<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EquipmentsFixture
 */
class EquipmentsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'serial_number' => 'Lorem ipsum dolor sit amet',
                'equipment_model' => 'Lorem ipsum dolor sit amet',
                'manufacturer' => 'Lorem ipsum dolor sit amet',
                'purchase_date' => '2025-07-17',
                'warranty_expiration' => '2025-07-17',
                'equipment_status' => 'Lorem ipsum dolor sit amet',
                'last_maintenance_date' => '2025-07-17',
                'next_maintenance_date' => '2025-07-17',
                'maintenance_frequency' => 1,
                'maximum_fuel' => 1,
                'minimum_fuel' => 1,
                'tracked_fuel' => 1,
                'created' => '2025-07-17 14:01:19',
                'modified' => '2025-07-17 14:01:19',
                'createdby' => 'Lorem ipsum dolor sit amet',
                'modifiedby' => 'Lorem ipsum dolor sit amet',
                'deleted' => 1,
            ],
        ];
        parent::init();
    }
}
