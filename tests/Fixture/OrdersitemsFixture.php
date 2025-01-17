<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OrdersitemsFixture
 */
class OrdersitemsFixture extends TestFixture
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
                'order_id' => 1,
                'qty' => 1,
                'unit_price' => 1,
                'subtotal' => 1,
                'created' => '2025-01-16 17:22:04',
                'modified' => '2025-01-16 17:22:04',
                'createdby' => 'Lorem ipsum dolor sit amet',
                'moodifiedby' => 'Lorem ipsum dolor sit amet',
                'deleted' => 1,
            ],
        ];
        parent::init();
    }
}
