<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PromotionsproductsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PromotionsproductsTable Test Case
 */
class PromotionsproductsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PromotionsproductsTable
     */
    protected $Promotionsproducts;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Promotionsproducts',
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
        $config = $this->getTableLocator()->exists('Promotionsproducts') ? [] : ['className' => PromotionsproductsTable::class];
        $this->Promotionsproducts = $this->getTableLocator()->get('Promotionsproducts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Promotionsproducts);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PromotionsproductsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\PromotionsproductsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
