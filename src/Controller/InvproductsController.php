<?php
declare(strict_types=1);

namespace App\Controller;

use Exception;

/**
 * Invproducts Controller
 *
 * @property \App\Model\Table\InvproductsTable $Invproducts
 */
class InvproductsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Invproducts->find()->where(['Invproducts.deleted' => 0])
            ->contain(['Users', 'Statuses']);
        $invproducts = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $this->set(compact('invproducts'));
    }

    /**
     * View method
     *
     * @param string|null $id Invproduct id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $invproduct = $this->Invproducts->get($id, contain: ['Users', 'Statuses', 'Inventories']);
        $this->set(compact('invproduct'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $invproduct = $this->Invproducts->newEmptyEntity();
        if ($this->request->is('post')) {
            $invproduct = $this->Invproducts->patchEntity($invproduct, $this->request->getData());

            $invproduct->createdby = $session->read('Auth.Username');
            $invproduct->modifiedby = $session->read('Auth.Username');
            $invproduct->deleted = 0;

            if ($this->Invproducts->save($invproduct)) {
                $this->Flash->success(__('The invproduct has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The invproduct could not be saved. Please, try again.'));
        }
        $users = $this->Invproducts->Users->find('list', limit: 200)->all();
        $statuses = $this->Invproducts->Statuses->find('list', limit: 200)->all();
        $this->set(compact('invproduct', 'users', 'statuses'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Invproduct id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $invproduct = $this->Invproducts->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $invproduct = $this->Invproducts->patchEntity($invproduct, $this->request->getData());

            $invproduct->modifiedby = $session->read('Auth.Username');

            if ($this->Invproducts->save($invproduct)) {
                $this->Flash->success(__('The invproduct has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The invproduct could not be saved. Please, try again.'));
        }
        $users = $this->Invproducts->Users->find('list', limit: 200)->all();
        $statuses = $this->Invproducts->Statuses->find('list', limit: 200)->all();
        $this->set(compact('invproduct', 'users', 'statuses'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Invproduct id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $invproduct = $this->Invproducts->get($id);

        $invproduct->modifiedby = $session->read('Auth.Username');
        $invproduct->deleted = 1;

        if ($this->Invproducts->save($invproduct)) {
            $this->Flash->success(__('The invproduct has been deleted.'));
        } else {
            $this->Flash->error(__('The invproduct could not be deleted. Please, try again.'));
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
        $invproduct = $this->Invproducts->newEmptyEntity();
        if ($this->request->is('post')) {
            $invproduct = $this->Invproducts->patchEntity($invproduct, $this->request->getData());

            $invproduct->createdby = $session->read('Auth.Username');
            $invproduct->modifiedby = $session->read('Auth.Username');
            $invproduct->deleted = 0;

            try{
                if ($this->Invproducts->save($invproduct)) {
                    $response = [
                        'message' => 'Data saved successfully!',
                        'data' => $invproduct->toArray()
                    ];
                }else {
                    $errors = $invproduct->getErrors();
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
