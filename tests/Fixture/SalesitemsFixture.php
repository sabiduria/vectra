<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SalesitemsFixture
 */
class SalesitemsFixture extends TestFixture
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
                'product_id' => 1,
                'sale_id' => 1,
                'qty' => 1,
                'packaging_id' => 1,
                'unit_price' => 1,
                'subtotal' => 1,
                'created' => '2025-01-16 17:22:07',
                'modified' => '2025-01-16 17:22:07',
                'createdby' => 'Lorem ipsum dolor sit amet',
                'modifiedby' => 'Lorem ipsum dolor sit amet',
                'deleted' => 1,
            ],
        ];
        parent::init();
    }
}
