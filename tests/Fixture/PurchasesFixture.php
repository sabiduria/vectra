<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PurchasesFixture
 */
class PurchasesFixture extends TestFixture
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
                'status_id' => 1,
                'supplier_id' => 1,
                'reference' => 'Lorem ipsum d',
                'qty' => 1,
                'receipt_date' => '2025-01-16 17:22:06',
                'created' => '2025-01-16 17:22:06',
                'modified' => '2025-01-16 17:22:06',
                'createdby' => 'Lorem ipsum dolor sit amet',
                'modifiedby' => 'Lorem ipsum dolor sit amet',
                'deleted' => 1,
            ],
        ];
        parent::init();
    }
}
