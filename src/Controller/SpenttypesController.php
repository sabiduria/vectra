<?php
declare(strict_types=1);

namespace App\Controller;

use Exception;

/**
 * Spenttypes Controller
 *
 * @property \App\Model\Table\SpenttypesTable $Spenttypes
 */
class SpenttypesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Spenttypes->find()->where(['Spenttypes.deleted' => 0]);
        $spenttypes = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $this->set(compact('spenttypes'));
    }

    /**
     * View method
     *
     * @param string|null $id Spenttype id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $spenttype = $this->Spenttypes->get($id, contain: ['Spents']);
        $this->set(compact('spenttype'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $spenttype = $this->Spenttypes->newEmptyEntity();
        if ($this->request->is('post')) {
            $spenttype = $this->Spenttypes->patchEntity($spenttype, $this->request->getData());

            $spenttype->createdby = $session->read('Auth.Username');
            $spenttype->modifiedby = $session->read('Auth.Username');
            $spenttype->deleted = 0;

            if ($this->Spenttypes->save($spenttype)) {
                $this->Flash->success(__('The spenttype has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The spenttype could not be saved. Please, try again.'));
        }
        $this->set(compact('spenttype'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Spenttype id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $spenttype = $this->Spenttypes->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $spenttype = $this->Spenttypes->patchEntity($spenttype, $this->request->getData());

            $spenttype->modifiedby = $session->read('Auth.Username');

            if ($this->Spenttypes->save($spenttype)) {
                $this->Flash->success(__('The spenttype has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The spenttype could not be saved. Please, try again.'));
        }
        $this->set(compact('spenttype'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Spenttype id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $spenttype = $this->Spenttypes->get($id);

        $spenttype->modifiedby = $session->read('Auth.Username');
        $spenttype->deleted = 1;

        if ($this->Spenttypes->save($spenttype)) {
            $this->Flash->success(__('The spenttype has been deleted.'));
        } else {
            $this->Flash->error(__('The spenttype could not be deleted. Please, try again.'));
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
        $spenttype = $this->Spenttypes->newEmptyEntity();
        if ($this->request->is('post')) {
            $spenttype = $this->Spenttypes->patchEntity($spenttype, $this->request->getData());

            $spenttype->createdby = $session->read('Auth.Username');
            $spenttype->modifiedby = $session->read('Auth.Username');
            $spenttype->deleted = 0;

            try{
                if ($this->Spenttypes->save($spenttype)) {
                    $response = [
                        'message' => 'Data saved successfully!',
                        'data' => $spenttype->toArray()
                    ];
                }else {
                    $errors = $spenttype->getErrors();
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
