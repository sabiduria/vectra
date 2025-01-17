<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SalesFixture
 */
class SalesFixture extends TestFixture
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
                'user_id' => 1,
                'customer_id' => 1,
                'reference' => 'Lorem ipsum d',
                'total_amount' => 1,
                'payment_method' => 'Lorem ipsum dolor sit amet',
                'status_id' => 1,
                'created' => '2025-01-17 14:10:51',
                'modified' => '2025-01-17 14:10:51',
                'createdby' => 'Lorem ipsum dolor sit amet',
                'modifiedby' => 'Lorem ipsum dolor sit amet',
                'deleted' => 1,
            ],
        ];
        parent::init();
    }
}
