<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FuelLevelsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FuelLevelsTable Test Case
 */
class FuelLevelsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FuelLevelsTable
     */
    protected $FuelLevels;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.FuelLevels',
        'app.Equipments',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('FuelLevels') ? [] : ['className' => FuelLevelsTable::class];
        $this->FuelLevels = $this->getTableLocator()->get('FuelLevels', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->FuelLevels);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\FuelLevelsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\FuelLevelsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
