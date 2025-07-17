<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MaintenanceTasksTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MaintenanceTasksTable Test Case
 */
class MaintenanceTasksTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MaintenanceTasksTable
     */
    protected $MaintenanceTasks;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.MaintenanceTasks',
        'app.MaintenanceRecords',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('MaintenanceTasks') ? [] : ['className' => MaintenanceTasksTable::class];
        $this->MaintenanceTasks = $this->getTableLocator()->get('MaintenanceTasks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->MaintenanceTasks);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\MaintenanceTasksTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\MaintenanceTasksTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
