<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PurchasesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PurchasesTable Test Case
 */
class PurchasesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PurchasesTable
     */
    protected $Purchases;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Purchases',
        'app.Statuses',
        'app.Suppliers',
        'app.Paymentstosuppliers',
        'app.Purchasesitems',
        'app.Spents',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Purchases') ? [] : ['className' => PurchasesTable::class];
        $this->Purchases = $this->getTableLocator()->get('Purchases', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Purchases);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PurchasesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\PurchasesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
