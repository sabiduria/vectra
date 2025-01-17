<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PurchasesitemsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PurchasesitemsTable Test Case
 */
class PurchasesitemsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PurchasesitemsTable
     */
    protected $Purchasesitems;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Purchasesitems',
        'app.Purchases',
        'app.Products',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Purchasesitems') ? [] : ['className' => PurchasesitemsTable::class];
        $this->Purchasesitems = $this->getTableLocator()->get('Purchasesitems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Purchasesitems);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PurchasesitemsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\PurchasesitemsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
