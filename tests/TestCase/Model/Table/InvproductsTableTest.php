<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InvproductsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InvproductsTable Test Case
 */
class InvproductsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\InvproductsTable
     */
    protected $Invproducts;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Invproducts',
        'app.Users',
        'app.Statuses',
        'app.Inventories',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Invproducts') ? [] : ['className' => InvproductsTable::class];
        $this->Invproducts = $this->getTableLocator()->get('Invproducts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Invproducts);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\InvproductsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\InvproductsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
