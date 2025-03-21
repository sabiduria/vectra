<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * StockinsFixture
 */
class StockinsFixture extends TestFixture
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
                'entrytype_id' => 1,
                'shop_id' => 1,
                'reference' => 'Lorem ipsum dolor sit amet',
                'created' => '2025-02-01 19:10:24',
                'modified' => '2025-02-01 19:10:24',
                'createdby' => 'Lorem ipsum dolor sit amet',
                'modifiedby' => 'Lorem ipsum dolor sit amet',
                'deleted' => 1,
            ],
        ];
        parent::init();
    }
}
