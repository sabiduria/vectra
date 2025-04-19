<?php
declare(strict_types=1);

namespace App\Controller;

use Exception;

/**
 * Purchases Controller
 *
 * @property \App\Model\Table\PurchasesTable $Purchases
 */
class PurchasesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Purchases->find()->where(['Purchases.deleted' => 0])
            ->contain(['Statuses', 'Suppliers']);
        $purchases = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $this->set(compact('purchases'));
    }

    /**
     * View method
     *
     * @param string|null $id Purchase id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $purchase = $this->Purchases->get($id, contain: ['Statuses', 'Suppliers', 'Paymentstosuppliers', 'Purchasesitems', 'Spents']);
        $spenttypes = $this->fetchTable('Spenttypes')->find('list')->all();
        $this->set(compact('purchase', 'spenttypes'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $purchase = $this->Purchases->newEmptyEntity();
        if ($this->request->is('post')) {
            $purchase = $this->Purchases->patchEntity($purchase, $this->request->getData());

            $purchase->createdby = $session->read('Auth.Username');
            $purchase->modifiedby = $session->read('Auth.Username');
            $purchase->deleted = 0;

            if ($this->Purchases->save($purchase)) {
                $this->Flash->success(__('The purchase has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase could not be saved. Please, try again.'));
        }
        $statuses = $this->Purchases->Statuses->find('list', limit: 200)->all();
        $suppliers = $this->Purchases->Suppliers->find('list', limit: 200)->all();
        $this->set(compact('purchase', 'statuses', 'suppliers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Purchase id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $purchase = $this->Purchases->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $purchase = $this->Purchases->patchEntity($purchase, $this->request->getData());

            $purchase->modifiedby = $session->read('Auth.Username');

            if ($this->Purchases->save($purchase)) {
                $this->Flash->success(__('The purchase has been saved.'));

                return $this->redirect(['controller' => 'purchasegroups', 'action' => 'view', $purchase->purchase_group_reference]);
            }
            $this->Flash->error(__('The purchase could not be saved. Please, try again.'));
        }
        $statuses = $this->Purchases->Statuses->find('list', limit: 200)->all();
        $suppliers = $this->Purchases->Suppliers->find('list', limit: 200)->all();
        $this->set(compact('purchase', 'statuses', 'suppliers'));
    }

    public function reception($id = null)
    {
        $session = $this->request->getSession();
        $purchase = $this->Purchases->get($id, contain: []);
        $purchase = $this->Purchases->patchEntity($purchase, $this->request->getData());

        $purchase->modifiedby = $session->read('Auth.Username');
        $purchase->receipt_date = date('Y-m-d');

        if ($this->Purchases->save($purchase)) {
            $this->Flash->success(__('The purchase has been saved.'));

            return $this->redirect(['controller' => 'purchasegroups', 'action' => 'view', $purchase->purchase_group_reference]);
        }
        $this->Flash->error(__('The purchase could not be saved. Please, try again.'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Purchase id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $purchase = $this->Purchases->get($id);

        $purchase->modifiedby = $session->read('Auth.Username');
        $purchase->deleted = 1;

        if ($this->Purchases->save($purchase)) {
            $this->Flash->success(__('The purchase has been deleted.'));
        } else {
            $this->Flash->error(__('The purchase could not be deleted. Please, try again.'));
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
        $purchase = $this->Purchases->newEmptyEntity();
        if ($this->request->is('post')) {
            $purchase = $this->Purchases->patchEntity($purchase, $this->request->getData());

            $purchase->createdby = $session->read('Auth.Username');
            $purchase->modifiedby = $session->read('Auth.Username');
            $purchase->deleted = 0;

            try{
                if ($this->Purchases->save($purchase)) {
                    $response = [
                        'message' => 'Data saved successfully!',
                        'data' => $purchase->toArray()
                    ];
                }else {
                    $errors = $purchase->getErrors();
                    $response = ['message' => 'Failed to save data.', 'errors' => $errors];
                }
            }
            catch (Exception $e) {
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

    public function purchase($product_id = null)
    {
        $this->viewBuilder()->setLayout('empty');
        $session = $this->request->getSession();

        $PGReference = $session->read('PGReference');
        $prospections = GeneralController::getProspectionsPrices($product_id);

        if($PGReference != null)
            $reference = $PGReference;
        else{
            $reference = GeneralController::NewPurchaseGroup(1, "Sabiduria");
            $session->write('PGReference', $reference);
        }

        if ($this->request->is('post')){
            $purchaseCheck = GeneralController::POForSupplierAlreadyAdd($reference, $_POST['SupplierId']);
            if (!$purchaseCheck){
                $PO = GeneralController::NewPurchaseOrder($_POST['SupplierId'], $reference, "Sabiduria");
                $PO_ID = GeneralController::getIDFromReference($PO, "Purchases");
            } else {
                $PO_ID = GeneralController::getPurchaseId($reference, $_POST['SupplierId']);
            }
            GeneralController::NewPurchaseOrderDetails($PO_ID, $_POST['ProductId'], $_POST['Qty'],  $_POST['Price'],"Sabiduria");
            return $this->redirect(['action' => 'purchase', $_POST['ProductId']]);
        }

        $PODetails = GeneralController::getPODetails($reference);

        $this->set(compact('prospections', 'reference', 'PODetails'));
    }
}
