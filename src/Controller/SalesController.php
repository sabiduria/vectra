<?php
declare(strict_types=1);

namespace App\Controller;

use Exception;

/**
 * Sales Controller
 *
 * @property \App\Model\Table\SalesTable $Sales
 */
class SalesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Sales->find()->where(['Sales.deleted' => 0])
            ->contain(['Users', 'Customers', 'Statuses']);
        $sales = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $this->set(compact('sales'));
    }

    /**
     * View method
     *
     * @param string|null $id Sale id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
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
    public function edit($id = null)
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
    public function delete($id = null)
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

            try{
                if ($this->Sales->save($sale)) {
                    $response = [
                        'message' => 'Data saved successfully!',
                        'data' => $sale->toArray()
                    ];
                }else {
                    $errors = $sale->getErrors();
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
