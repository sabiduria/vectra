<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MarketProspectionsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MarketProspectionsTable Test Case
 */
class MarketProspectionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MarketProspectionsTable
     */
    protected $MarketProspections;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.MarketProspections',
        'app.Products',
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
        $config = $this->getTableLocator()->exists('MarketProspections') ? [] : ['className' => MarketProspectionsTable::class];
        $this->MarketProspections = $this->getTableLocator()->get('MarketProspections', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->MarketProspections);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\MarketProspectionsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\MarketProspectionsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
