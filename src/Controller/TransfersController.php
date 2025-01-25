<?php
declare(strict_types=1);

namespace App\Controller;

use Exception;

/**
 * Transfers Controller
 *
 * @property \App\Model\Table\TransfersTable $Transfers
 */
class TransfersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Transfers->find()->where(['Transfers.deleted' => 0])
            ->contain(['Shops']);
        $transfers = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $this->set(compact('transfers'));
    }

    /**
     * View method
     *
     * @param string|null $id Transfer id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $transfer = $this->Transfers->get($id, contain: ['Shops', 'Transfersdetails']);
        $this->set(compact('transfer'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $transfer = $this->Transfers->newEmptyEntity();
        if ($this->request->is('post')) {
            $transfer = $this->Transfers->patchEntity($transfer, $this->request->getData());

            $transfer->createdby = $session->read('Auth.Username');
            $transfer->modifiedby = $session->read('Auth.Username');
            $transfer->deleted = 0;

            if ($this->Transfers->save($transfer)) {
                $this->Flash->success(__('The transfer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The transfer could not be saved. Please, try again.'));
        }
        $shops = $this->Transfers->Shops->find('list', limit: 200)->all();
        $this->set(compact('transfer', 'shops'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Transfer id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $transfer = $this->Transfers->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $transfer = $this->Transfers->patchEntity($transfer, $this->request->getData());

            $transfer->modifiedby = $session->read('Auth.Username');

            if ($this->Transfers->save($transfer)) {
                $this->Flash->success(__('The transfer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The transfer could not be saved. Please, try again.'));
        }
        $shops = $this->Transfers->Shops->find('list', limit: 200)->all();
        $this->set(compact('transfer', 'shops'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Transfer id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $transfer = $this->Transfers->get($id);

        $transfer->modifiedby = $session->read('Auth.Username');
        $transfer->deleted = 1;

        if ($this->Transfers->save($transfer)) {
            $this->Flash->success(__('The transfer has been deleted.'));
        } else {
            $this->Flash->error(__('The transfer could not be deleted. Please, try again.'));
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
        $transfer = $this->Transfers->newEmptyEntity();
        if ($this->request->is('post')) {
            $transfer = $this->Transfers->patchEntity($transfer, $this->request->getData());

            $transfer->createdby = $session->read('Auth.Username');
            $transfer->modifiedby = $session->read('Auth.Username');
            $transfer->deleted = 0;

            try{
                if ($this->Transfers->save($transfer)) {
                    $response = [
                        'message' => 'Data saved successfully!',
                        'data' => $transfer->toArray()
                    ];
                }else {
                    $errors = $transfer->getErrors();
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
