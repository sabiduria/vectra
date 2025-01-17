<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrdersitemsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrdersitemsTable Test Case
 */
class OrdersitemsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OrdersitemsTable
     */
    protected $Ordersitems;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Ordersitems',
        'app.Products',
        'app.Orders',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Ordersitems') ? [] : ['className' => OrdersitemsTable::class];
        $this->Ordersitems = $this->getTableLocator()->get('Ordersitems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Ordersitems);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\OrdersitemsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\OrdersitemsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
