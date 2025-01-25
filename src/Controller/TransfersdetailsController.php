<?php
declare(strict_types=1);

namespace App\Controller;

use Exception;

/**
 * Transfersdetails Controller
 *
 * @property \App\Model\Table\TransfersdetailsTable $Transfersdetails
 */
class TransfersdetailsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Transfersdetails->find()->where(['Transfersdetails.deleted' => 0])
            ->contain(['Transfers', 'Products']);
        $transfersdetails = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $this->set(compact('transfersdetails'));
    }

    /**
     * View method
     *
     * @param string|null $id Transfersdetail id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $transfersdetail = $this->Transfersdetails->get($id, contain: ['Transfers', 'Products']);
        $this->set(compact('transfersdetail'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $transfersdetail = $this->Transfersdetails->newEmptyEntity();
        if ($this->request->is('post')) {
            $transfersdetail = $this->Transfersdetails->patchEntity($transfersdetail, $this->request->getData());

            $transfersdetail->createdby = $session->read('Auth.Username');
            $transfersdetail->modifiedby = $session->read('Auth.Username');
            $transfersdetail->deleted = 0;

            if ($this->Transfersdetails->save($transfersdetail)) {
                $this->Flash->success(__('The transfersdetail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The transfersdetail could not be saved. Please, try again.'));
        }
        $transfers = $this->Transfersdetails->Transfers->find('list', limit: 200)->all();
        $products = $this->Transfersdetails->Products->find('list', limit: 200)->all();
        $this->set(compact('transfersdetail', 'transfers', 'products'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Transfersdetail id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $transfersdetail = $this->Transfersdetails->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $transfersdetail = $this->Transfersdetails->patchEntity($transfersdetail, $this->request->getData());

            $transfersdetail->modifiedby = $session->read('Auth.Username');

            if ($this->Transfersdetails->save($transfersdetail)) {
                $this->Flash->success(__('The transfersdetail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The transfersdetail could not be saved. Please, try again.'));
        }
        $transfers = $this->Transfersdetails->Transfers->find('list', limit: 200)->all();
        $products = $this->Transfersdetails->Products->find('list', limit: 200)->all();
        $this->set(compact('transfersdetail', 'transfers', 'products'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Transfersdetail id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $transfersdetail = $this->Transfersdetails->get($id);

        $transfersdetail->modifiedby = $session->read('Auth.Username');
        $transfersdetail->deleted = 1;

        if ($this->Transfersdetails->save($transfersdetail)) {
            $this->Flash->success(__('The transfersdetail has been deleted.'));
        } else {
            $this->Flash->error(__('The transfersdetail could not be deleted. Please, try again.'));
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
        $transfersdetail = $this->Transfersdetails->newEmptyEntity();
        if ($this->request->is('post')) {
            $transfersdetail = $this->Transfersdetails->patchEntity($transfersdetail, $this->request->getData());

            $transfersdetail->createdby = $session->read('Auth.Username');
            $transfersdetail->modifiedby = $session->read('Auth.Username');
            $transfersdetail->deleted = 0;

            try{
                if ($this->Transfersdetails->save($transfersdetail)) {
                    $response = [
                        'message' => 'Data saved successfully!',
                        'data' => $transfersdetail->toArray()
                    ];
                }else {
                    $errors = $transfersdetail->getErrors();
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
