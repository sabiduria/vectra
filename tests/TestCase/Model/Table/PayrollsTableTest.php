<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PayrollsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PayrollsTable Test Case
 */
class PayrollsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PayrollsTable
     */
    protected $Payrolls;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Payrolls',
        'app.Salaries',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Payrolls') ? [] : ['className' => PayrollsTable::class];
        $this->Payrolls = $this->getTableLocator()->get('Payrolls', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Payrolls);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PayrollsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\PayrollsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
