<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TransfersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TransfersTable Test Case
 */
class TransfersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TransfersTable
     */
    protected $Transfers;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Transfers',
        'app.Shops',
        'app.Transfersdetails',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Transfers') ? [] : ['className' => TransfersTable::class];
        $this->Transfers = $this->getTableLocator()->get('Transfers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Transfers);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TransfersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\TransfersTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
