<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AccessrightsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AccessrightsTable Test Case
 */
class AccessrightsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AccessrightsTable
     */
    protected $Accessrights;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Accessrights',
        'app.Profiles',
        'app.Resources',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Accessrights') ? [] : ['className' => AccessrightsTable::class];
        $this->Accessrights = $this->getTableLocator()->get('Accessrights', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Accessrights);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\AccessrightsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\AccessrightsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
