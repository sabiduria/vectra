<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PartsUsedsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PartsUsedsTable Test Case
 */
class PartsUsedsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PartsUsedsTable
     */
    protected $PartsUseds;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.PartsUseds',
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
        $config = $this->getTableLocator()->exists('PartsUseds') ? [] : ['className' => PartsUsedsTable::class];
        $this->PartsUseds = $this->getTableLocator()->get('PartsUseds', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->PartsUseds);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PartsUsedsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\PartsUsedsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
