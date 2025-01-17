<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StockinsdetailsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StockinsdetailsTable Test Case
 */
class StockinsdetailsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\StockinsdetailsTable
     */
    protected $Stockinsdetails;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Stockinsdetails',
        'app.Products',
        'app.Stockins',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Stockinsdetails') ? [] : ['className' => StockinsdetailsTable::class];
        $this->Stockinsdetails = $this->getTableLocator()->get('Stockinsdetails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Stockinsdetails);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\StockinsdetailsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\StockinsdetailsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
