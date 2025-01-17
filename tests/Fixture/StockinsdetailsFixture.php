<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * StockinsdetailsFixture
 */
class StockinsdetailsFixture extends TestFixture
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
                'stockin_id' => 1,
                'purchase_price' => 1,
                'barcode' => 'Lorem ipsum dolor sit amet',
                'qty' => 1,
                'expiry_date' => '2025-01-17',
                'created' => '2025-01-17 14:10:52',
                'modified' => '2025-01-17 14:10:52',
                'createdby' => 'Lorem ipsum dolor sit amet',
                'modifiedby' => 'Lorem ipsum dolor sit amet',
                'deleted' => 1,
            ],
        ];
        parent::init();
    }
}
