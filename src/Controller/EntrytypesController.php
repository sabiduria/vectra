<?php
declare(strict_types=1);

namespace App\Controller;

use Exception;

/**
 * Entrytypes Controller
 *
 * @property \App\Model\Table\EntrytypesTable $Entrytypes
 */
class EntrytypesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Entrytypes->find()->where(['Entrytypes.deleted' => 0]);
        $entrytypes = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $this->set(compact('entrytypes'));
    }

    /**
     * View method
     *
     * @param string|null $id Entrytype id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $entrytype = $this->Entrytypes->get($id, contain: ['Stockins']);
        $this->set(compact('entrytype'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $entrytype = $this->Entrytypes->newEmptyEntity();
        if ($this->request->is('post')) {
            $entrytype = $this->Entrytypes->patchEntity($entrytype, $this->request->getData());

            $entrytype->createdby = $session->read('Auth.Username');
            $entrytype->modifiedby = $session->read('Auth.Username');
            $entrytype->deleted = 0;

            if ($this->Entrytypes->save($entrytype)) {
                $this->Flash->success(__('The entrytype has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The entrytype could not be saved. Please, try again.'));
        }
        $this->set(compact('entrytype'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Entrytype id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $entrytype = $this->Entrytypes->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $entrytype = $this->Entrytypes->patchEntity($entrytype, $this->request->getData());

            $entrytype->modifiedby = $session->read('Auth.Username');

            if ($this->Entrytypes->save($entrytype)) {
                $this->Flash->success(__('The entrytype has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The entrytype could not be saved. Please, try again.'));
        }
        $this->set(compact('entrytype'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Entrytype id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $entrytype = $this->Entrytypes->get($id);

        $entrytype->modifiedby = $session->read('Auth.Username');
        $entrytype->deleted = 1;

        if ($this->Entrytypes->save($entrytype)) {
            $this->Flash->success(__('The entrytype has been deleted.'));
        } else {
            $this->Flash->error(__('The entrytype could not be deleted. Please, try again.'));
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
        $entrytype = $this->Entrytypes->newEmptyEntity();
        if ($this->request->is('post')) {
            $entrytype = $this->Entrytypes->patchEntity($entrytype, $this->request->getData());

            $entrytype->createdby = $session->read('Auth.Username');
            $entrytype->modifiedby = $session->read('Auth.Username');
            $entrytype->deleted = 0;

            try{
                if ($this->Entrytypes->save($entrytype)) {
                    $response = [
                        'message' => 'Data saved successfully!',
                        'data' => $entrytype->toArray()
                    ];
                }else {
                    $errors = $entrytype->getErrors();
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
