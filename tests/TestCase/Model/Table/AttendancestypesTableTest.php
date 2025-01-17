<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AttendancestypesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AttendancestypesTable Test Case
 */
class AttendancestypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AttendancestypesTable
     */
    protected $Attendancestypes;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Attendancestypes',
        'app.Attendances',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Attendancestypes') ? [] : ['className' => AttendancestypesTable::class];
        $this->Attendancestypes = $this->getTableLocator()->get('Attendancestypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Attendancestypes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\AttendancestypesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
