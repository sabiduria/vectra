<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\MarketProspectionsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\MarketProspectionsController Test Case
 *
 * @uses \App\Controller\MarketProspectionsController
 */
class MarketProspectionsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.MarketProspections',
        'app.Products',
        'app.Packagings',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\MarketProspectionsController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\MarketProspectionsController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\MarketProspectionsController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\MarketProspectionsController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\MarketProspectionsController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test insert method
     *
     * @return void
     * @uses \App\Controller\MarketProspectionsController::insert()
     */
    public function testInsert(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
