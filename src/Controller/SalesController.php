<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\ConnectionManager;
use Cake\Http\Exception\InternalErrorException;
use Cake\I18n\DateTime;
use Cake\ORM\Table;
use Exception;

/**
 * Sales Controller
 *
 * @property \App\Model\Table\SalesTable $Sales
 */
class SalesController extends AppController
{
    // Load the SalesItems model
    private Table $SalesItems;
    protected PrinterService $printer;

    public function initialize(): void
    {
        parent::initialize();
        $this->printer = new PrinterService();
        $this->SalesItems = $this->fetchTable('Salesitems');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Sales->find()->where(['Sales.deleted' => 0])
            ->contain(['Users', 'Customers', 'Statuses'])->orderByDesc('Sales.id');
        $sales = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000,]);

        $this->set(compact('sales'));
    }

    /**
     * View method
     *
     * @param string|null $id Sale id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $sale = $this->Sales->get($id, contain: ['Users', 'Customers', 'Statuses', 'Salesitems']);
        $this->set(compact('sale'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $sale = $this->Sales->newEmptyEntity();
        if ($this->request->is('post')) {
            $sale = $this->Sales->patchEntity($sale, $this->request->getData());

            $sale->createdby = $session->read('Auth.Username');
            $sale->modifiedby = $session->read('Auth.Username');
            $sale->deleted = 0;

            if ($this->Sales->save($sale)) {
                $this->Flash->success(__('The sale has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sale could not be saved. Please, try again.'));
        }
        $users = $this->Sales->Users->find('list', limit: 200)->all();
        $customers = $this->Sales->Customers->find('list', limit: 200)->all();
        $statuses = $this->Sales->Statuses->find('list', limit: 200)->all();
        $this->set(compact('sale', 'users', 'customers', 'statuses'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sale id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $session = $this->request->getSession();
        $sale = $this->Sales->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sale = $this->Sales->patchEntity($sale, $this->request->getData());

            $sale->modifiedby = $session->read('Auth.Username');

            if ($this->Sales->save($sale)) {
                $this->Flash->success(__('The sale has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sale could not be saved. Please, try again.'));
        }
        $users = $this->Sales->Users->find('list', limit: 200)->all();
        $customers = $this->Sales->Customers->find('list', limit: 200)->all();
        $statuses = $this->Sales->Statuses->find('list', limit: 200)->all();
        $this->set(compact('sale', 'users', 'customers', 'statuses'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sale id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $sale = $this->Sales->get($id);

        $sale->modifiedby = $session->read('Auth.Username');
        $sale->deleted = 1;

        if ($this->Sales->save($sale)) {
            $this->Flash->success(__('The sale has been deleted.'));
        } else {
            $this->Flash->error(__('The sale could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Insert method
     */
    public function insert()
    {
        $this->request->allowMethod(['ajax', 'post']);
        $session = $this->request->getSession();
        $sale = $this->Sales->newEmptyEntity();
        if ($this->request->is('post')) {
            $sale = $this->Sales->patchEntity($sale, $this->request->getData());

            $sale->createdby = $session->read('Auth.Username');
            $sale->modifiedby = $session->read('Auth.Username');
            $sale->deleted = 0;

            try {
                if ($this->Sales->save($sale)) {
                    $response = [
                        'message' => 'Data saved successfully!',
                        'data' => $sale->toArray(),
                    ];
                } else {
                    $errors = $sale->getErrors();
                    $response = ['message' => 'Failed to save data.', 'errors' => $errors];
                }
            } catch (Exception $e) {
                $response = ['message' => 'An error occurred: ' . $e->getMessage()];
            }
            // Set the response type to JSON
            $this->response = $this->response->withType('application/json');

            // Serialize the response to JSON
            $this->set(compact('response'));
            $this->set('_serialize', ['response']); // Automatically serializes the response variable as JSON

            // Ensure the response is sent as JSON (no need for a view)
            return $this->response->withStringBody(json_encode($response));
        }
    }

    public function pos()
    {
        $session = $this->request->getSession();
        $this->viewBuilder()->setLayout('empty');

        $username = $session->read('Auth.Username');
        $user_id = $session->read('Auth.Id');
        $reference = $session->read('SalesReference');
        $salesId = $session->read('SalesId');

        if ($this->request->is('post')) {
            if (!$session->check('SalesId')) {
                $this->NewSales(1, 'sabiduria');
            }
            $packaging_id = $_POST['packaging_id'] ?? null;

            GeneralController::NewSalesItems($_POST['barcode'], $packaging_id, 'sabiduria');

            return $this->redirect(['action' => 'pos']);
        }

        if ($salesId != null) {
            $salesDetails = GeneralController::getSalesDetails($salesId);
            $salesAmount = GeneralController::getSalesAmount($salesId);
            $vat = $salesAmount * 15 / 100;
            $discount = 0;
            $total = $salesAmount - $discount;
        } else {
            $salesDetails = null;
            $salesAmount = 0;
            $vat = 0;
            $discount = 0;
            $total = 0;
        }

        $this->set(compact('reference', 'salesDetails', 'salesAmount', 'vat', 'total'));
    }

    public function NewSales($user_id, $username): void
    {
        $session = $this->request->getSession();
        $connection = ConnectionManager::get('default');

        $reference = GeneralController::generateReference('Sales', 'FCT');
        $connection->insert('Sales', [
            'user_id' => $user_id,
            'customer_id' => null,
            'reference' => $reference,
            'total_amount' => 0,
            'payment_method' => null,
            'status_id' => 1,
            'created' => new DateTime('now'),
            'modified' => new DateTime('now'),
            'createdby' => $username,
            'modifiedby' => $username,
            'deleted' => 0,
        ], ['created' => 'datetime', 'modified' => 'datetime']);

        // Get the last inserted ID
        $salesId = GeneralController::getLastIdInsertedBy($username, 'Sales');

        // Store both reference and sales ID in session
        $session->write('SalesReference', $reference);
        $session->write('SalesId', $salesId);
        //return $this->redirect(['controller' => 'sales', 'action' => 'pos']);
    }

    public function destroySession()
    {
        $this->request->getSession()->destroy();
    }

    public function updateItem()
    {
        $session = $this->request->getSession();
        $this->autoRender = false; // We don't need a view for this request
        $this->request->allowMethod(['post']); // Only allow POST requests
        $salesId = $session->read('SalesId');

        // Get the posted data
        $productId = $this->request->getData('product_id');
        $qty = $this->request->getData('qty');
        $subtotal = $this->request->getData('subtotal');

        // Find the sales item by product_id and sale_id
        $salesItem = $this->SalesItems->find()
            ->where(['product_id' => $productId, 'sale_id' => $salesId])
            ->first();

        if ($salesItem) {
            // Update the sales item with new qty and subtotal
            $salesItem->qty = $qty;
            $salesItem->subtotal = $subtotal;

            if ($this->SalesItems->save($salesItem)) {
                $salesAmount = GeneralController::getSalesAmount($salesId);
                $vat = $salesAmount * 15 / 100;
                $discount = 0;
                $total = $salesAmount + $vat - $discount;

                echo json_encode(['success' => true, 'message' => 'Item updated successfully', 'subtotal' => $salesAmount,
                    'vat' => $vat,
                    'total' => $total]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to update item']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Item not found']);
        }
    }

    public function updateBill()
    {
        $session = $this->request->getSession();
        $this->autoRender = false; // We don't need a view for this request
        $this->request->allowMethod(['post']); // Only allow POST requests
        $salesId = $session->read('SalesId');

        $client_phone = $this->request->getData('client_code');
        $customer_id = GeneralController::getClientIDFromPhone($client_phone);
        $total_amount = GeneralController::getSalesAmount($salesId);

        $sale = $this->Sales->get($salesId, contain: []);

        $sale->customer_id = $customer_id;
        $sale->total_amount = $total_amount;
        $sale->status_id = 4;

        if ($this->Sales->save($sale)) {
            try {
                //$receiptText = "CakePHP 5 Receipt\nItem 1 - $10\nTotal: $10\n";
                //$this->printer->printReceipt($receiptText);
                //$this->Flash->success('Printed successfully!');
                $this->request->getSession()->delete('SalesId');
            } catch (Exception $e) {
                throw new InternalErrorException('Print failed: ' . $e->getMessage());
            }

            return $this->redirect(['action' => 'pos']);
        }
        $this->Flash->error(__('The sale could not be saved. Please, try again.'));
    }
}
