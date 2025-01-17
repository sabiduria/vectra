<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SpoilagesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SpoilagesTable Test Case
 */
class SpoilagesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SpoilagesTable
     */
    protected $Spoilages;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Spoilages',
        'app.Products',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Spoilages') ? [] : ['className' => SpoilagesTable::class];
        $this->Spoilages = $this->getTableLocator()->get('Spoilages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Spoilages);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\SpoilagesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\SpoilagesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
