<?php
declare(strict_types=1);

namespace App\Controller;

use Exception;

/**
 * Paymentstosuppliers Controller
 *
 * @property \App\Model\Table\PaymentstosuppliersTable $Paymentstosuppliers
 */
class PaymentstosuppliersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Paymentstosuppliers->find()->where(['Paymentstosuppliers.deleted' => 0])
            ->contain(['Purchases']);
        $paymentstosuppliers = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $this->set(compact('paymentstosuppliers'));
    }

    /**
     * View method
     *
     * @param string|null $id Paymentstosupplier id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $paymentstosupplier = $this->Paymentstosuppliers->get($id, contain: ['Purchases']);
        $this->set(compact('paymentstosupplier'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $paymentstosupplier = $this->Paymentstosuppliers->newEmptyEntity();
        if ($this->request->is('post')) {
            $paymentstosupplier = $this->Paymentstosuppliers->patchEntity($paymentstosupplier, $this->request->getData());

            $paymentstosupplier->createdby = $session->read('Auth.Username');
            $paymentstosupplier->modifiedby = $session->read('Auth.Username');
            $paymentstosupplier->deleted = 0;

            if ($this->Paymentstosuppliers->save($paymentstosupplier)) {
                $this->Flash->success(__('The paymentstosupplier has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The paymentstosupplier could not be saved. Please, try again.'));
        }
        $purchases = $this->Paymentstosuppliers->Purchases->find('list', limit: 200)->all();
        $this->set(compact('paymentstosupplier', 'purchases'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Paymentstosupplier id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $paymentstosupplier = $this->Paymentstosuppliers->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $paymentstosupplier = $this->Paymentstosuppliers->patchEntity($paymentstosupplier, $this->request->getData());

            $paymentstosupplier->modifiedby = $session->read('Auth.Username');

            if ($this->Paymentstosuppliers->save($paymentstosupplier)) {
                $this->Flash->success(__('The paymentstosupplier has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The paymentstosupplier could not be saved. Please, try again.'));
        }
        $purchases = $this->Paymentstosuppliers->Purchases->find('list', limit: 200)->all();
        $this->set(compact('paymentstosupplier', 'purchases'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Paymentstosupplier id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $paymentstosupplier = $this->Paymentstosuppliers->get($id);

        $paymentstosupplier->modifiedby = $session->read('Auth.Username');
        $paymentstosupplier->deleted = 1;

        if ($this->Paymentstosuppliers->save($paymentstosupplier)) {
            $this->Flash->success(__('The paymentstosupplier has been deleted.'));
        } else {
            $this->Flash->error(__('The paymentstosupplier could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Insert method
     */
    public function insert($purchase_id)
    {
        $this->request->allowMethod(['ajax', 'post']);
        $session = $this->request->getSession();
        $paymentstosupplier = $this->Paymentstosuppliers->newEmptyEntity();
        if ($this->request->is('post')) {
            $paymentstosupplier = $this->Paymentstosuppliers->patchEntity($paymentstosupplier, $this->request->getData());

            $paymentstosupplier->purchase_id = $purchase_id;
            $paymentstosupplier->createdby = $session->read('Auth.Username');
            $paymentstosupplier->modifiedby = $session->read('Auth.Username');
            $paymentstosupplier->deleted = 0;

            try{
                if ($this->Paymentstosuppliers->save($paymentstosupplier)) {
                    $response = [
                        'message' => 'Data saved successfully!',
                        'data' => $paymentstosupplier->toArray()
                    ];
                }else {
                    $errors = $paymentstosupplier->getErrors();
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
}
