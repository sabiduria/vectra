<?php
declare(strict_types=1);

namespace App\Controller;

use Exception;

/**
 * Loyaltypoints Controller
 *
 * @property \App\Model\Table\LoyaltypointsTable $Loyaltypoints
 */
class LoyaltypointsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Loyaltypoints->find()->where(['Loyaltypoints.deleted' => 0])
            ->contain(['Customers']);
        $loyaltypoints = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $this->set(compact('loyaltypoints'));
    }

    /**
     * View method
     *
     * @param string|null $id Loyaltypoint id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $loyaltypoint = $this->Loyaltypoints->get($id, contain: ['Customers']);
        $this->set(compact('loyaltypoint'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $loyaltypoint = $this->Loyaltypoints->newEmptyEntity();
        if ($this->request->is('post')) {
            $loyaltypoint = $this->Loyaltypoints->patchEntity($loyaltypoint, $this->request->getData());

            $loyaltypoint->createdby = $session->read('Auth.Username');
            $loyaltypoint->modifiedby = $session->read('Auth.Username');
            $loyaltypoint->deleted = 0;

            if ($this->Loyaltypoints->save($loyaltypoint)) {
                $this->Flash->success(__('The loyaltypoint has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The loyaltypoint could not be saved. Please, try again.'));
        }
        $customers = $this->Loyaltypoints->Customers->find('list', limit: 200)->all();
        $this->set(compact('loyaltypoint', 'customers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Loyaltypoint id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $loyaltypoint = $this->Loyaltypoints->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $loyaltypoint = $this->Loyaltypoints->patchEntity($loyaltypoint, $this->request->getData());

            $loyaltypoint->modifiedby = $session->read('Auth.Username');

            if ($this->Loyaltypoints->save($loyaltypoint)) {
                $this->Flash->success(__('The loyaltypoint has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The loyaltypoint could not be saved. Please, try again.'));
        }
        $customers = $this->Loyaltypoints->Customers->find('list', limit: 200)->all();
        $this->set(compact('loyaltypoint', 'customers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Loyaltypoint id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $loyaltypoint = $this->Loyaltypoints->get($id);

        $loyaltypoint->modifiedby = $session->read('Auth.Username');
        $loyaltypoint->deleted = 1;

        if ($this->Loyaltypoints->save($loyaltypoint)) {
            $this->Flash->success(__('The loyaltypoint has been deleted.'));
        } else {
            $this->Flash->error(__('The loyaltypoint could not be deleted. Please, try again.'));
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
        $loyaltypoint = $this->Loyaltypoints->newEmptyEntity();
        if ($this->request->is('post')) {
            $loyaltypoint = $this->Loyaltypoints->patchEntity($loyaltypoint, $this->request->getData());

            $loyaltypoint->createdby = $session->read('Auth.Username');
            $loyaltypoint->modifiedby = $session->read('Auth.Username');
            $loyaltypoint->deleted = 0;

            try{
                if ($this->Loyaltypoints->save($loyaltypoint)) {
                    $response = [
                        'message' => 'Data saved successfully!',
                        'data' => $loyaltypoint->toArray()
                    ];
                }else {
                    $errors = $loyaltypoint->getErrors();
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
