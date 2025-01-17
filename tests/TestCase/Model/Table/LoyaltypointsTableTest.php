<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LoyaltypointsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LoyaltypointsTable Test Case
 */
class LoyaltypointsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LoyaltypointsTable
     */
    protected $Loyaltypoints;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Loyaltypoints',
        'app.Customers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Loyaltypoints') ? [] : ['className' => LoyaltypointsTable::class];
        $this->Loyaltypoints = $this->getTableLocator()->get('Loyaltypoints', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Loyaltypoints);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\LoyaltypointsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\LoyaltypointsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
