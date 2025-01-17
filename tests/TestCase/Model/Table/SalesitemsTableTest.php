<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SalesitemsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SalesitemsTable Test Case
 */
class SalesitemsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SalesitemsTable
     */
    protected $Salesitems;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Salesitems',
        'app.Products',
        'app.Sales',
        'app.Packagings',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Salesitems') ? [] : ['className' => SalesitemsTable::class];
        $this->Salesitems = $this->getTableLocator()->get('Salesitems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Salesitems);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\SalesitemsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\SalesitemsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
