<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * InvproductsFixture
 */
class InvproductsFixture extends TestFixture
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
                'reference' => 'Lorem ipsum d',
                'inventory_period' => 'Lorem ipsum dolor sit amet',
                'start_date' => '2025-02-01',
                'end_date' => '2025-02-01',
                'user_id' => 1,
                'status_id' => 1,
                'created' => '2025-02-01 18:55:37',
                'modified' => '2025-02-01 18:55:37',
                'createdby' => 'Lorem ipsum dolor sit amet',
                'modifiedby' => 'Lorem ipsum dolor sit amet',
                'deleted' => 1,
            ],
        ];
        parent::init();
    }
}
