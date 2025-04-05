<?php
declare(strict_types=1);

namespace App\Controller;

use Exception;

/**
 * Prospections Controller
 *
 * @property \App\Model\Table\ProspectionsTable $Prospections
 */
class ProspectionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->add();
        $query = $this->Prospections->find()->where(['Prospections.deleted' => 0])
            ->contain(['Products', 'Suppliers', 'Packagings']);
        $prospections = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $this->set(compact('prospections'));
    }

    /**
     * View method
     *
     * @param string|null $id Prospection id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $prospection = $this->Prospections->get($id, contain: ['Products', 'Suppliers', 'Packagings']);
        $this->set(compact('prospection'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $prospection = $this->Prospections->newEmptyEntity();
        if ($this->request->is('post')) {
            $prospection = $this->Prospections->patchEntity($prospection, $this->request->getData());

            $prospection->createdby = $session->read('Auth.Username');
            $prospection->modifiedby = $session->read('Auth.Username');
            $prospection->deleted = 0;

            if ($this->Prospections->save($prospection)) {
                $this->Flash->success(__('The prospection has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The prospection could not be saved. Please, try again.'));
        }
        $products = $this->Prospections->Products->find('list', limit: 200)->all();
        $suppliers = $this->Prospections->Suppliers->find('list', limit: 200)->all();
        $packagings = $this->Prospections->Packagings->find('list', limit: 200)->all();
        $this->set(compact('prospection', 'products', 'suppliers', 'packagings'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Prospection id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $prospection = $this->Prospections->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $prospection = $this->Prospections->patchEntity($prospection, $this->request->getData());

            $prospection->modifiedby = $session->read('Auth.Username');

            if ($this->Prospections->save($prospection)) {
                $this->Flash->success(__('The prospection has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The prospection could not be saved. Please, try again.'));
        }
        $products = $this->Prospections->Products->find('list', limit: 200)->all();
        $suppliers = $this->Prospections->Suppliers->find('list', limit: 200)->all();
        $packagings = $this->Prospections->Packagings->find('list', limit: 200)->all();
        $this->set(compact('prospection', 'products', 'suppliers', 'packagings'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Prospection id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $prospection = $this->Prospections->get($id);

        $prospection->modifiedby = $session->read('Auth.Username');
        $prospection->deleted = 1;

        if ($this->Prospections->save($prospection)) {
            $this->Flash->success(__('The prospection has been deleted.'));
        } else {
            $this->Flash->error(__('The prospection could not be deleted. Please, try again.'));
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
        $prospection = $this->Prospections->newEmptyEntity();
        if ($this->request->is('post')) {
            $prospection = $this->Prospections->patchEntity($prospection, $this->request->getData());

            $prospection->createdby = $session->read('Auth.Username');
            $prospection->modifiedby = $session->read('Auth.Username');
            $prospection->deleted = 0;

            try{
                if ($this->Prospections->save($prospection)) {
                    $response = [
                        'message' => 'Data saved successfully!',
                        'data' => $prospection->toArray()
                    ];
                }else {
                    $errors = $prospection->getErrors();
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
