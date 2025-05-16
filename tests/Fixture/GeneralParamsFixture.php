<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * GeneralParamsFixture
 */
class GeneralParamsFixture extends TestFixture
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
                'rccm' => 'Lorem ipsum dolor sit amet',
                'idnat' => 'Lorem ipsum dolor sit amet',
                'impot' => 'Lorem ipsum dolor sit amet',
                'printer_name' => 'Lorem ipsum dolor sit amet',
                'printer_ip' => 'Lorem ipsum dolor sit amet',
                'growth' => 1,
                'created' => '2025-05-16 10:54:50',
                'modified' => '2025-05-16 10:54:50',
                'createdby' => 'Lorem ipsum dolor sit amet',
                'modifiedby' => 'Lorem ipsum dolor sit amet',
                'deleted' => 1,
            ],
        ];
        parent::init();
    }
}
