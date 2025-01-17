<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PackagingsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PackagingsTable Test Case
 */
class PackagingsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PackagingsTable
     */
    protected $Packagings;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Packagings',
        'app.Pricings',
        'app.Products',
        'app.Salesitems',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Packagings') ? [] : ['className' => PackagingsTable::class];
        $this->Packagings = $this->getTableLocator()->get('Packagings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Packagings);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PackagingsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
