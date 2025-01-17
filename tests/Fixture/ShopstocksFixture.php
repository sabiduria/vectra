<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ShopstocksFixture
 */
class ShopstocksFixture extends TestFixture
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
                'shop_id' => 1,
                'product_id' => 1,
                'room_id' => 1,
                'stock' => 1,
                'stock_min' => 1,
                'created' => '2025-01-16 17:22:08',
                'modified' => '2025-01-16 17:22:08',
                'createdby' => 'Lorem ipsum dolor sit amet',
                'modifiedby' => 'Lorem ipsum dolor sit amet',
                'deleted' => 1,
            ],
        ];
        parent::init();
    }
}
