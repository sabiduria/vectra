<?php
declare(strict_types=1);

namespace App\Controller;

use Exception;

/**
 * Auditlogs Controller
 *
 * @property \App\Model\Table\AuditlogsTable $Auditlogs
 */
class AuditlogsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Auditlogs->find()->where(['Auditlogs.deleted' => 0]);
        $auditlogs = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $this->set(compact('auditlogs'));
    }

    /**
     * View method
     *
     * @param string|null $id Auditlog id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $auditlog = $this->Auditlogs->get($id, contain: []);
        $this->set(compact('auditlog'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $auditlog = $this->Auditlogs->newEmptyEntity();
        if ($this->request->is('post')) {
            $auditlog = $this->Auditlogs->patchEntity($auditlog, $this->request->getData());

            $auditlog->createdby = $session->read('Auth.Username');
            $auditlog->modifiedby = $session->read('Auth.Username');
            $auditlog->deleted = 0;

            if ($this->Auditlogs->save($auditlog)) {
                $this->Flash->success(__('The auditlog has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The auditlog could not be saved. Please, try again.'));
        }
        $this->set(compact('auditlog'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Auditlog id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $auditlog = $this->Auditlogs->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $auditlog = $this->Auditlogs->patchEntity($auditlog, $this->request->getData());

            $auditlog->modifiedby = $session->read('Auth.Username');

            if ($this->Auditlogs->save($auditlog)) {
                $this->Flash->success(__('The auditlog has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The auditlog could not be saved. Please, try again.'));
        }
        $this->set(compact('auditlog'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Auditlog id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $auditlog = $this->Auditlogs->get($id);

        $auditlog->modifiedby = $session->read('Auth.Username');
        $auditlog->deleted = 1;

        if ($this->Auditlogs->save($auditlog)) {
            $this->Flash->success(__('The auditlog has been deleted.'));
        } else {
            $this->Flash->error(__('The auditlog could not be deleted. Please, try again.'));
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
        $auditlog = $this->Auditlogs->newEmptyEntity();
        if ($this->request->is('post')) {
            $auditlog = $this->Auditlogs->patchEntity($auditlog, $this->request->getData());

            $auditlog->createdby = $session->read('Auth.Username');
            $auditlog->modifiedby = $session->read('Auth.Username');
            $auditlog->deleted = 0;

            try{
                if ($this->Auditlogs->save($auditlog)) {
                    $response = [
                        'message' => 'Data saved successfully!',
                        'data' => $auditlog->toArray()
                    ];
                }else {
                    $errors = $auditlog->getErrors();
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
