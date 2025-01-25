<?php
declare(strict_types=1);

namespace App\Controller;

use Exception;

/**
 * Exchangerates Controller
 *
 * @property \App\Model\Table\ExchangeratesTable $Exchangerates
 */
class ExchangeratesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Exchangerates->find()->where(['Exchangerates.deleted' => 0]);
        $exchangerates = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $this->set(compact('exchangerates'));
    }

    /**
     * View method
     *
     * @param string|null $id Exchangerate id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $exchangerate = $this->Exchangerates->get($id, contain: []);
        $this->set(compact('exchangerate'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $exchangerate = $this->Exchangerates->newEmptyEntity();
        if ($this->request->is('post')) {
            $exchangerate = $this->Exchangerates->patchEntity($exchangerate, $this->request->getData());

            $exchangerate->createdby = $session->read('Auth.Username');
            $exchangerate->modifiedby = $session->read('Auth.Username');
            $exchangerate->deleted = 0;

            if ($this->Exchangerates->save($exchangerate)) {
                $this->Flash->success(__('The exchangerate has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The exchangerate could not be saved. Please, try again.'));
        }
        $this->set(compact('exchangerate'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Exchangerate id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $exchangerate = $this->Exchangerates->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $exchangerate = $this->Exchangerates->patchEntity($exchangerate, $this->request->getData());

            $exchangerate->modifiedby = $session->read('Auth.Username');

            if ($this->Exchangerates->save($exchangerate)) {
                $this->Flash->success(__('The exchangerate has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The exchangerate could not be saved. Please, try again.'));
        }
        $this->set(compact('exchangerate'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Exchangerate id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $exchangerate = $this->Exchangerates->get($id);

        $exchangerate->modifiedby = $session->read('Auth.Username');
        $exchangerate->deleted = 1;

        if ($this->Exchangerates->save($exchangerate)) {
            $this->Flash->success(__('The exchangerate has been deleted.'));
        } else {
            $this->Flash->error(__('The exchangerate could not be deleted. Please, try again.'));
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
        $exchangerate = $this->Exchangerates->newEmptyEntity();
        if ($this->request->is('post')) {
            $exchangerate = $this->Exchangerates->patchEntity($exchangerate, $this->request->getData());

            $exchangerate->createdby = $session->read('Auth.Username');
            $exchangerate->modifiedby = $session->read('Auth.Username');
            $exchangerate->deleted = 0;

            try{
                if ($this->Exchangerates->save($exchangerate)) {
                    $response = [
                        'message' => 'Data saved successfully!',
                        'data' => $exchangerate->toArray()
                    ];
                }else {
                    $errors = $exchangerate->getErrors();
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
