<?php
declare(strict_types=1);

namespace App\Controller;

use Exception;

/**
 * Spents Controller
 *
 * @property \App\Model\Table\SpentsTable $Spents
 */
class SpentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Spents->find()->where(['Spents.deleted' => 0])
            ->contain(['Purchases', 'Spenttypes']);
        $spents = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $this->set(compact('spents'));
    }

    /**
     * View method
     *
     * @param string|null $id Spent id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $spent = $this->Spents->get($id, contain: ['Purchases', 'Spenttypes']);
        $this->set(compact('spent'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $spent = $this->Spents->newEmptyEntity();
        if ($this->request->is('post')) {
            $spent = $this->Spents->patchEntity($spent, $this->request->getData());

            $spent->createdby = $session->read('Auth.Username');
            $spent->modifiedby = $session->read('Auth.Username');
            $spent->deleted = 0;

            if ($this->Spents->save($spent)) {
                $this->Flash->success(__('The spent has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The spent could not be saved. Please, try again.'));
        }
        $purchases = $this->Spents->Purchases->find('list', limit: 200)->all();
        $spenttypes = $this->Spents->Spenttypes->find('list', limit: 200)->all();
        $this->set(compact('spent', 'purchases', 'spenttypes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Spent id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $spent = $this->Spents->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $spent = $this->Spents->patchEntity($spent, $this->request->getData());

            $spent->modifiedby = $session->read('Auth.Username');

            if ($this->Spents->save($spent)) {
                $this->Flash->success(__('The spent has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The spent could not be saved. Please, try again.'));
        }
        $purchases = $this->Spents->Purchases->find('list', limit: 200)->all();
        $spenttypes = $this->Spents->Spenttypes->find('list', limit: 200)->all();
        $this->set(compact('spent', 'purchases', 'spenttypes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Spent id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $spent = $this->Spents->get($id);

        $spent->modifiedby = $session->read('Auth.Username');
        $spent->deleted = 1;

        if ($this->Spents->save($spent)) {
            $this->Flash->success(__('The spent has been deleted.'));
        } else {
            $this->Flash->error(__('The spent could not be deleted. Please, try again.'));
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
        $spent = $this->Spents->newEmptyEntity();
        if ($this->request->is('post')) {
            $spent = $this->Spents->patchEntity($spent, $this->request->getData());

            $spent->purchase_id = $purchase_id;
            $spent->createdby = $session->read('Auth.Username');
            $spent->modifiedby = $session->read('Auth.Username');
            $spent->deleted = 0;

            try{
                if ($this->Spents->save($spent)) {
                    $response = [
                        'message' => 'Data saved successfully!',
                        'data' => $spent->toArray()
                    ];
                }else {
                    $errors = $spent->getErrors();
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
