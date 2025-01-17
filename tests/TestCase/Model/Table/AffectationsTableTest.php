<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AffectationsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AffectationsTable Test Case
 */
class AffectationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AffectationsTable
     */
    protected $Affectations;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Affectations',
        'app.Users',
        'app.Profiles',
        'app.Shops',
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
        $config = $this->getTableLocator()->exists('Affectations') ? [] : ['className' => AffectationsTable::class];
        $this->Affectations = $this->getTableLocator()->get('Affectations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Affectations);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\AffectationsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\AffectationsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
