<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ExchangeratesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ExchangeratesTable Test Case
 */
class ExchangeratesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ExchangeratesTable
     */
    protected $Exchangerates;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Exchangerates',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Exchangerates') ? [] : ['className' => ExchangeratesTable::class];
        $this->Exchangerates = $this->getTableLocator()->get('Exchangerates', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Exchangerates);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ExchangeratesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
