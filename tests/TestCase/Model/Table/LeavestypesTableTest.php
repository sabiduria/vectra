<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LeavestypesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LeavestypesTable Test Case
 */
class LeavestypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LeavestypesTable
     */
    protected $Leavestypes;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Leavestypes',
        'app.Leaves',
        'app.Leavesbalances',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Leavestypes') ? [] : ['className' => LeavestypesTable::class];
        $this->Leavestypes = $this->getTableLocator()->get('Leavestypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Leavestypes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\LeavestypesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
