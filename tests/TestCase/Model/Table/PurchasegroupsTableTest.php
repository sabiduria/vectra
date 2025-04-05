<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PurchasegroupsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PurchasegroupsTable Test Case
 */
class PurchasegroupsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PurchasegroupsTable
     */
    protected $Purchasegroups;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Purchasegroups',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Purchasegroups') ? [] : ['className' => PurchasegroupsTable::class];
        $this->Purchasegroups = $this->getTableLocator()->get('Purchasegroups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Purchasegroups);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PurchasegroupsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
