<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\ProspectionsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\ProspectionsController Test Case
 *
 * @uses \App\Controller\ProspectionsController
 */
class ProspectionsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Prospections',
        'app.Products',
        'app.Suppliers',
        'app.Packagings',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\ProspectionsController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\ProspectionsController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\ProspectionsController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\ProspectionsController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\ProspectionsController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test insert method
     *
     * @return void
     * @uses \App\Controller\ProspectionsController::insert()
     */
    public function testInsert(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
