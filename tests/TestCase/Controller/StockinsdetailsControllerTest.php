<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\StockinsdetailsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\StockinsdetailsController Test Case
 *
 * @uses \App\Controller\StockinsdetailsController
 */
class StockinsdetailsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Stockinsdetails',
        'app.Products',
        'app.Stockins',
        'app.Rooms',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\StockinsdetailsController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\StockinsdetailsController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\StockinsdetailsController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\StockinsdetailsController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\StockinsdetailsController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test insert method
     *
     * @return void
     * @uses \App\Controller\StockinsdetailsController::insert()
     */
    public function testInsert(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
