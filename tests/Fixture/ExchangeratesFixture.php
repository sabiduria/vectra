<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ExchangeratesFixture
 */
class ExchangeratesFixture extends TestFixture
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
                'currency_from' => 1,
                'currency_to' => 1,
                'rates' => 1,
                'isactived' => 1,
                'created' => '2025-01-17 14:10:46',
                'modified' => '2025-01-17 14:10:46',
                'createdby' => 'Lorem ipsum dolor sit amet',
                'modifiedby' => 'Lorem ipsum dolor sit amet',
                'deleted' => 1,
            ],
        ];
        parent::init();
    }
}
