<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
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
                'firstname' => 'Lorem ipsum dolor sit amet',
                'lastname' => 'Lorem ipsum dolor sit amet',
                'address' => 'Lorem ipsum dolor sit amet',
                'phone1' => 'Lorem ipsum d',
                'phone2' => 'Lorem ipsum d',
                'leave_days_month' => 1,
                'employeetype' => 'Lorem ipsum dolor sit amet',
                'username' => 'Lorem ipsum dolor sit amet',
                'password' => 'Lorem ipsum dolor sit amet',
                'created' => '2025-01-25 19:51:15',
                'modified' => '2025-01-25 19:51:15',
                'createdby' => 'Lorem ipsum dolor sit amet',
                'modifiedby' => 'Lorem ipsum dolor sit amet',
                'deleted' => 1,
            ],
        ];
        parent::init();
    }
}
