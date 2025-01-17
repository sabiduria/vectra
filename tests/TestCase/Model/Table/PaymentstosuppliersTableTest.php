<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PaymentstosuppliersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PaymentstosuppliersTable Test Case
 */
class PaymentstosuppliersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PaymentstosuppliersTable
     */
    protected $Paymentstosuppliers;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Paymentstosuppliers',
        'app.Purchases',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Paymentstosuppliers') ? [] : ['className' => PaymentstosuppliersTable::class];
        $this->Paymentstosuppliers = $this->getTableLocator()->get('Paymentstosuppliers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Paymentstosuppliers);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PaymentstosuppliersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\PaymentstosuppliersTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
