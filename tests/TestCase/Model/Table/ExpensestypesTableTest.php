<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ExpensestypesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ExpensestypesTable Test Case
 */
class ExpensestypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ExpensestypesTable
     */
    protected $Expensestypes;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Expensestypes',
        'app.Expenses',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Expensestypes') ? [] : ['className' => ExpensestypesTable::class];
        $this->Expensestypes = $this->getTableLocator()->get('Expensestypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Expensestypes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ExpensestypesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
