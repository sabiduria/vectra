<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ShopstocksTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ShopstocksTable Test Case
 */
class ShopstocksTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ShopstocksTable
     */
    protected $Shopstocks;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Shopstocks',
        'app.Shops',
        'app.Products',
        'app.Rooms',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Shopstocks') ? [] : ['className' => ShopstocksTable::class];
        $this->Shopstocks = $this->getTableLocator()->get('Shopstocks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Shopstocks);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ShopstocksTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ShopstocksTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
