<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AuditlogsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AuditlogsTable Test Case
 */
class AuditlogsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AuditlogsTable
     */
    protected $Auditlogs;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Auditlogs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Auditlogs') ? [] : ['className' => AuditlogsTable::class];
        $this->Auditlogs = $this->getTableLocator()->get('Auditlogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Auditlogs);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\AuditlogsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
