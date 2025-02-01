<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StockinsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StockinsTable Test Case
 */
class StockinsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\StockinsTable
     */
    protected $Stockins;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Stockins',
        'app.Entrytypes',
        'app.Shops',
        'app.Stockinsdetails',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Stockins') ? [] : ['className' => StockinsTable::class];
        $this->Stockins = $this->getTableLocator()->get('Stockins', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Stockins);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\StockinsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\StockinsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
