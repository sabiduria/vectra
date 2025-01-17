<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * HolidaysFixture
 */
class HolidaysFixture extends TestFixture
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
                'holidaydate' => '2025-01-16',
                'description' => 'Lorem ipsum dolor sit amet',
                'created' => '2025-01-16 17:22:03',
                'modified' => '2025-01-16 17:22:03',
                'createdby' => 'Lorem ipsum dolor sit amet',
                'modifiedby' => 'Lorem ipsum dolor sit amet',
                'deleted' => 1,
            ],
        ];
        parent::init();
    }
}
