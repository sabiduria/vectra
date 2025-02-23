<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PricingsFixture
 */
class PricingsFixture extends TestFixture
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
                'barcode' => 'Lorem ipsum d',
                'product_id' => 1,
                'packaging_id' => 1,
                'unit_price' => 1,
                'wholesale_price' => 1,
                'special_price' => 1,
                'created' => '2025-02-08 11:45:56',
                'modified' => '2025-02-08 11:45:56',
                'createdby' => 'Lorem ipsum dolor sit amet',
                'modifiedby' => 'Lorem ipsum dolor sit amet',
                'deleted' => 1,
            ],
        ];
        parent::init();
    }
}
