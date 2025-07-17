<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PartsUsedsFixture
 */
class PartsUsedsFixture extends TestFixture
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
                'maintenance_record_id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'quantity' => 1,
                'unit_cost' => 1,
                'created' => '2025-07-17 13:49:42',
                'modified' => '2025-07-17 13:49:42',
                'createdby' => 'Lorem ipsum dolor sit amet',
                'modifiedby' => 'Lorem ipsum dolor sit amet',
                'deleted' => 1,
            ],
        ];
        parent::init();
    }
}
