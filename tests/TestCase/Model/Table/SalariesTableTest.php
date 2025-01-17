<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SalariesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SalariesTable Test Case
 */
class SalariesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SalariesTable
     */
    protected $Salaries;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Salaries',
        'app.Users',
        'app.Payrolls',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Salaries') ? [] : ['className' => SalariesTable::class];
        $this->Salaries = $this->getTableLocator()->get('Salaries', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Salaries);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\SalariesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\SalariesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
