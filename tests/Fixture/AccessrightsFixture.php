<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AccessrightsFixture
 */
class AccessrightsFixture extends TestFixture
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
                'profile_id' => 1,
                'resource_id' => 1,
                'c' => 1,
                'r' => 1,
                'u' => 1,
                'd' => 1,
                'p' => 1,
                'v' => 1,
                'created' => '2025-01-17 14:10:43',
                'modified' => '2025-01-17 14:10:43',
                'createdby' => 'Lorem ipsum dolor sit amet',
                'modifiedby' => 'Lorem ipsum dolor sit amet',
                'deleted' => 1,
            ],
        ];
        parent::init();
    }
}
