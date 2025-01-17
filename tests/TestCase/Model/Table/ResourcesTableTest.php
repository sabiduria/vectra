<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ResourcesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ResourcesTable Test Case
 */
class ResourcesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ResourcesTable
     */
    protected $Resources;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Resources',
        'app.Accessrights',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Resources') ? [] : ['className' => ResourcesTable::class];
        $this->Resources = $this->getTableLocator()->get('Resources', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Resources);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ResourcesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
