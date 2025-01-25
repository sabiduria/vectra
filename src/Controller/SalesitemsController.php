<?php
declare(strict_types=1);

namespace App\Controller;

use Exception;

/**
 * Salesitems Controller
 *
 * @property \App\Model\Table\SalesitemsTable $Salesitems
 */
class SalesitemsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Salesitems->find()->where(['Salesitems.deleted' => 0])
            ->contain(['Products', 'Sales', 'Packagings']);
        $salesitems = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $this->set(compact('salesitems'));
    }

    /**
     * View method
     *
     * @param string|null $id Salesitem id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $salesitem = $this->Salesitems->get($id, contain: ['Products', 'Sales', 'Packagings']);
        $this->set(compact('salesitem'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $salesitem = $this->Salesitems->newEmptyEntity();
        if ($this->request->is('post')) {
            $salesitem = $this->Salesitems->patchEntity($salesitem, $this->request->getData());

            $salesitem->createdby = $session->read('Auth.Username');
            $salesitem->modifiedby = $session->read('Auth.Username');
            $salesitem->deleted = 0;

            if ($this->Salesitems->save($salesitem)) {
                $this->Flash->success(__('The salesitem has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The salesitem could not be saved. Please, try again.'));
        }
        $products = $this->Salesitems->Products->find('list', limit: 200)->all();
        $sales = $this->Salesitems->Sales->find('list', limit: 200)->all();
        $packagings = $this->Salesitems->Packagings->find('list', limit: 200)->all();
        $this->set(compact('salesitem', 'products', 'sales', 'packagings'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Salesitem id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $salesitem = $this->Salesitems->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $salesitem = $this->Salesitems->patchEntity($salesitem, $this->request->getData());

            $salesitem->modifiedby = $session->read('Auth.Username');

            if ($this->Salesitems->save($salesitem)) {
                $this->Flash->success(__('The salesitem has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The salesitem could not be saved. Please, try again.'));
        }
        $products = $this->Salesitems->Products->find('list', limit: 200)->all();
        $sales = $this->Salesitems->Sales->find('list', limit: 200)->all();
        $packagings = $this->Salesitems->Packagings->find('list', limit: 200)->all();
        $this->set(compact('salesitem', 'products', 'sales', 'packagings'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Salesitem id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $salesitem = $this->Salesitems->get($id);

        $salesitem->modifiedby = $session->read('Auth.Username');
        $salesitem->deleted = 1;

        if ($this->Salesitems->save($salesitem)) {
            $this->Flash->success(__('The salesitem has been deleted.'));
        } else {
            $this->Flash->error(__('The salesitem could not be deleted. Please, try again.'));
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
        $salesitem = $this->Salesitems->newEmptyEntity();
        if ($this->request->is('post')) {
            $salesitem = $this->Salesitems->patchEntity($salesitem, $this->request->getData());

            $salesitem->createdby = $session->read('Auth.Username');
            $salesitem->modifiedby = $session->read('Auth.Username');
            $salesitem->deleted = 0;

            try{
                if ($this->Salesitems->save($salesitem)) {
                    $response = [
                        'message' => 'Data saved successfully!',
                        'data' => $salesitem->toArray()
                    ];
                }else {
                    $errors = $salesitem->getErrors();
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
