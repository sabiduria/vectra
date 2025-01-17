<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LeavesbalancesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LeavesbalancesTable Test Case
 */
class LeavesbalancesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LeavesbalancesTable
     */
    protected $Leavesbalances;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Leavesbalances',
        'app.Users',
        'app.Leavestypes',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Leavesbalances') ? [] : ['className' => LeavesbalancesTable::class];
        $this->Leavesbalances = $this->getTableLocator()->get('Leavesbalances', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Leavesbalances);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\LeavesbalancesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\LeavesbalancesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
