<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MaintenanceRecordsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MaintenanceRecordsTable Test Case
 */
class MaintenanceRecordsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MaintenanceRecordsTable
     */
    protected $MaintenanceRecords;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.MaintenanceRecords',
        'app.Equipments',
        'app.MaintenanceTasks',
        'app.PartsUseds',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('MaintenanceRecords') ? [] : ['className' => MaintenanceRecordsTable::class];
        $this->MaintenanceRecords = $this->getTableLocator()->get('MaintenanceRecords', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->MaintenanceRecords);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\MaintenanceRecordsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\MaintenanceRecordsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
