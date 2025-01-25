<?php
declare(strict_types=1);

namespace App\Controller;

use Exception;

/**
 * Packagings Controller
 *
 * @property \App\Model\Table\PackagingsTable $Packagings
 */
class PackagingsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Packagings->find()->where(['Packagings.deleted' => 0]);
        $packagings = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $this->set(compact('packagings'));
    }

    /**
     * View method
     *
     * @param string|null $id Packaging id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $packaging = $this->Packagings->get($id, contain: ['Pricings', 'Products', 'Salesitems']);
        $this->set(compact('packaging'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $packaging = $this->Packagings->newEmptyEntity();
        if ($this->request->is('post')) {
            $packaging = $this->Packagings->patchEntity($packaging, $this->request->getData());

            $packaging->createdby = $session->read('Auth.Username');
            $packaging->modifiedby = $session->read('Auth.Username');
            $packaging->deleted = 0;

            if ($this->Packagings->save($packaging)) {
                $this->Flash->success(__('The packaging has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The packaging could not be saved. Please, try again.'));
        }
        $this->set(compact('packaging'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Packaging id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $packaging = $this->Packagings->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $packaging = $this->Packagings->patchEntity($packaging, $this->request->getData());

            $packaging->modifiedby = $session->read('Auth.Username');

            if ($this->Packagings->save($packaging)) {
                $this->Flash->success(__('The packaging has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The packaging could not be saved. Please, try again.'));
        }
        $this->set(compact('packaging'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Packaging id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $packaging = $this->Packagings->get($id);

        $packaging->modifiedby = $session->read('Auth.Username');
        $packaging->deleted = 1;

        if ($this->Packagings->save($packaging)) {
            $this->Flash->success(__('The packaging has been deleted.'));
        } else {
            $this->Flash->error(__('The packaging could not be deleted. Please, try again.'));
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
        $packaging = $this->Packagings->newEmptyEntity();
        if ($this->request->is('post')) {
            $packaging = $this->Packagings->patchEntity($packaging, $this->request->getData());

            $packaging->createdby = $session->read('Auth.Username');
            $packaging->modifiedby = $session->read('Auth.Username');
            $packaging->deleted = 0;

            try{
                if ($this->Packagings->save($packaging)) {
                    $response = [
                        'message' => 'Data saved successfully!',
                        'data' => $packaging->toArray()
                    ];
                }else {
                    $errors = $packaging->getErrors();
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
