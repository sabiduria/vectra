<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GeneralParamsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GeneralParamsTable Test Case
 */
class GeneralParamsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\GeneralParamsTable
     */
    protected $GeneralParams;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.GeneralParams',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('GeneralParams') ? [] : ['className' => GeneralParamsTable::class];
        $this->GeneralParams = $this->getTableLocator()->get('GeneralParams', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->GeneralParams);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\GeneralParamsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
