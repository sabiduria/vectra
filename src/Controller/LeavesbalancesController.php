<?php
declare(strict_types=1);

namespace App\Controller;

use Exception;

/**
 * Leavesbalances Controller
 *
 * @property \App\Model\Table\LeavesbalancesTable $Leavesbalances
 */
class LeavesbalancesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Leavesbalances->find()->where(['Leavesbalances.deleted' => 0])
            ->contain(['Users', 'Leavestypes']);
        $leavesbalances = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $this->set(compact('leavesbalances'));
    }

    /**
     * View method
     *
     * @param string|null $id Leavesbalance id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $leavesbalance = $this->Leavesbalances->get($id, contain: ['Users', 'Leavestypes']);
        $this->set(compact('leavesbalance'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $leavesbalance = $this->Leavesbalances->newEmptyEntity();
        if ($this->request->is('post')) {
            $leavesbalance = $this->Leavesbalances->patchEntity($leavesbalance, $this->request->getData());

            $leavesbalance->createdby = $session->read('Auth.Username');
            $leavesbalance->modifiedby = $session->read('Auth.Username');
            $leavesbalance->deleted = 0;

            if ($this->Leavesbalances->save($leavesbalance)) {
                $this->Flash->success(__('The leavesbalance has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The leavesbalance could not be saved. Please, try again.'));
        }
        $users = $this->Leavesbalances->Users->find('list', limit: 200)->all();
        $leavestypes = $this->Leavesbalances->Leavestypes->find('list', limit: 200)->all();
        $this->set(compact('leavesbalance', 'users', 'leavestypes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Leavesbalance id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $leavesbalance = $this->Leavesbalances->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $leavesbalance = $this->Leavesbalances->patchEntity($leavesbalance, $this->request->getData());

            $leavesbalance->modifiedby = $session->read('Auth.Username');

            if ($this->Leavesbalances->save($leavesbalance)) {
                $this->Flash->success(__('The leavesbalance has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The leavesbalance could not be saved. Please, try again.'));
        }
        $users = $this->Leavesbalances->Users->find('list', limit: 200)->all();
        $leavestypes = $this->Leavesbalances->Leavestypes->find('list', limit: 200)->all();
        $this->set(compact('leavesbalance', 'users', 'leavestypes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Leavesbalance id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $leavesbalance = $this->Leavesbalances->get($id);

        $leavesbalance->modifiedby = $session->read('Auth.Username');
        $leavesbalance->deleted = 1;

        if ($this->Leavesbalances->save($leavesbalance)) {
            $this->Flash->success(__('The leavesbalance has been deleted.'));
        } else {
            $this->Flash->error(__('The leavesbalance could not be deleted. Please, try again.'));
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
        $leavesbalance = $this->Leavesbalances->newEmptyEntity();
        if ($this->request->is('post')) {
            $leavesbalance = $this->Leavesbalances->patchEntity($leavesbalance, $this->request->getData());

            $leavesbalance->createdby = $session->read('Auth.Username');
            $leavesbalance->modifiedby = $session->read('Auth.Username');
            $leavesbalance->deleted = 0;

            try{
                if ($this->Leavesbalances->save($leavesbalance)) {
                    $response = [
                        'message' => 'Data saved successfully!',
                        'data' => $leavesbalance->toArray()
                    ];
                }else {
                    $errors = $leavesbalance->getErrors();
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
