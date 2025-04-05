<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\PurchasegroupsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\PurchasegroupsController Test Case
 *
 * @uses \App\Controller\PurchasegroupsController
 */
class PurchasegroupsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Purchasegroups',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\PurchasegroupsController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\PurchasegroupsController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\PurchasegroupsController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\PurchasegroupsController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\PurchasegroupsController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test insert method
     *
     * @return void
     * @uses \App\Controller\PurchasegroupsController::insert()
     */
    public function testInsert(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
