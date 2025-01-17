<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PayrollsFixture
 */
class PayrollsFixture extends TestFixture
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
                'salary_id' => 1,
                'period_start' => '2025-01-17',
                'period_end' => '2025-01-17',
                'period_salary' => 1,
                'salary_payed' => 1,
                'deductions' => 1,
                'bonus' => 1,
                'totally_payed' => 1,
                'created' => '2025-01-17 14:10:49',
                'modified' => '2025-01-17 14:10:49',
                'createdby' => 'Lorem ipsum dolor sit amet',
                'modifiedby' => 'Lorem ipsum dolor sit amet',
                'deleted' => 1,
            ],
        ];
        parent::init();
    }
}
