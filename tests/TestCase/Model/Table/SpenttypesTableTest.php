<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SpenttypesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SpenttypesTable Test Case
 */
class SpenttypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SpenttypesTable
     */
    protected $Spenttypes;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Spenttypes',
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
        $config = $this->getTableLocator()->exists('Spenttypes') ? [] : ['className' => SpenttypesTable::class];
        $this->Spenttypes = $this->getTableLocator()->get('Spenttypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Spenttypes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\SpenttypesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
