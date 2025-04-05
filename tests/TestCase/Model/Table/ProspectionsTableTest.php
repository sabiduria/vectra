<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProspectionsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProspectionsTable Test Case
 */
class ProspectionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProspectionsTable
     */
    protected $Prospections;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Prospections',
        'app.Products',
        'app.Suppliers',
        'app.Packagings',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Prospections') ? [] : ['className' => ProspectionsTable::class];
        $this->Prospections = $this->getTableLocator()->get('Prospections', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Prospections);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ProspectionsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ProspectionsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
