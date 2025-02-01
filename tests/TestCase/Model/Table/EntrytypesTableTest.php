<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EntrytypesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EntrytypesTable Test Case
 */
class EntrytypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EntrytypesTable
     */
    protected $Entrytypes;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Entrytypes',
        'app.Stockins',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Entrytypes') ? [] : ['className' => EntrytypesTable::class];
        $this->Entrytypes = $this->getTableLocator()->get('Entrytypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Entrytypes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\EntrytypesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
