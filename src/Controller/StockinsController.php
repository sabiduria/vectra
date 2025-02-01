<?php
declare(strict_types=1);

namespace App\Controller;

use Exception;

/**
 * Stockins Controller
 *
 * @property \App\Model\Table\StockinsTable $Stockins
 */
class StockinsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Stockins->find()->where(['Stockins.deleted' => 0])
            ->contain(['Entrytypes', 'Shops']);
        $stockins = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $this->set(compact('stockins'));
    }

    /**
     * View method
     *
     * @param string|null $id Stockin id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $stockin = $this->Stockins->get($id, contain: ['Entrytypes', 'Shops', 'Stockinsdetails']);
        $this->set(compact('stockin'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $stockin = $this->Stockins->newEmptyEntity();
        if ($this->request->is('post')) {
            $stockin = $this->Stockins->patchEntity($stockin, $this->request->getData());

            $stockin->createdby = $session->read('Auth.Username');
            $stockin->modifiedby = $session->read('Auth.Username');
            $stockin->deleted = 0;

            if ($this->Stockins->save($stockin)) {
                $this->Flash->success(__('The stockin has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The stockin could not be saved. Please, try again.'));
        }
        $entrytypes = $this->Stockins->Entrytypes->find('list', limit: 200)->all();
        $shops = $this->Stockins->Shops->find('list', limit: 200)->all();
        $this->set(compact('stockin', 'entrytypes', 'shops'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Stockin id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $stockin = $this->Stockins->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $stockin = $this->Stockins->patchEntity($stockin, $this->request->getData());

            $stockin->modifiedby = $session->read('Auth.Username');

            if ($this->Stockins->save($stockin)) {
                $this->Flash->success(__('The stockin has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The stockin could not be saved. Please, try again.'));
        }
        $entrytypes = $this->Stockins->Entrytypes->find('list', limit: 200)->all();
        $shops = $this->Stockins->Shops->find('list', limit: 200)->all();
        $this->set(compact('stockin', 'entrytypes', 'shops'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Stockin id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $stockin = $this->Stockins->get($id);

        $stockin->modifiedby = $session->read('Auth.Username');
        $stockin->deleted = 1;

        if ($this->Stockins->save($stockin)) {
            $this->Flash->success(__('The stockin has been deleted.'));
        } else {
            $this->Flash->error(__('The stockin could not be deleted. Please, try again.'));
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
        $stockin = $this->Stockins->newEmptyEntity();
        if ($this->request->is('post')) {
            $stockin = $this->Stockins->patchEntity($stockin, $this->request->getData());

            $stockin->createdby = $session->read('Auth.Username');
            $stockin->modifiedby = $session->read('Auth.Username');
            $stockin->deleted = 0;

            try{
                if ($this->Stockins->save($stockin)) {
                    $response = [
                        'message' => 'Data saved successfully!',
                        'data' => $stockin->toArray()
                    ];
                }else {
                    $errors = $stockin->getErrors();
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
