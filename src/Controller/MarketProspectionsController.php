<?php
declare(strict_types=1);

namespace App\Controller;

use Exception;

/**
 * MarketProspections Controller
 *
 * @property \App\Model\Table\MarketProspectionsTable $MarketProspections
 */
class MarketProspectionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->MarketProspections->find()->where(['MarketProspections.deleted' => 0])
            ->contain(['Products', 'Packagings']);
        $marketProspections = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $this->set(compact('marketProspections'));
    }

    /**
     * View method
     *
     * @param string|null $id Market Prospection id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $marketProspection = $this->MarketProspections->get($id, contain: ['Products', 'Packagings']);
        $this->set(compact('marketProspection'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $marketProspection = $this->MarketProspections->newEmptyEntity();
        if ($this->request->is('post')) {
            $marketProspection = $this->MarketProspections->patchEntity($marketProspection, $this->request->getData());

            $marketProspection->createdby = $session->read('Auth.Username');
            $marketProspection->modifiedby = $session->read('Auth.Username');
            $marketProspection->deleted = 0;

            if ($this->MarketProspections->save($marketProspection)) {
                $this->Flash->success(__('The market prospection has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The market prospection could not be saved. Please, try again.'));
        }
        $products = $this->MarketProspections->Products->find('list', limit: 200)->all();
        $packagings = $this->MarketProspections->Packagings->find('list', limit: 200)->all();
        $this->set(compact('marketProspection', 'products', 'packagings'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Market Prospection id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $marketProspection = $this->MarketProspections->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $marketProspection = $this->MarketProspections->patchEntity($marketProspection, $this->request->getData());

            $marketProspection->modifiedby = $session->read('Auth.Username');

            if ($this->MarketProspections->save($marketProspection)) {
                $this->Flash->success(__('The market prospection has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The market prospection could not be saved. Please, try again.'));
        }
        $products = $this->MarketProspections->Products->find('list', limit: 200)->all();
        $packagings = $this->MarketProspections->Packagings->find('list', limit: 200)->all();
        $this->set(compact('marketProspection', 'products', 'packagings'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Market Prospection id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $marketProspection = $this->MarketProspections->get($id);

        $marketProspection->modifiedby = $session->read('Auth.Username');
        $marketProspection->deleted = 1;

        if ($this->MarketProspections->save($marketProspection)) {
            $this->Flash->success(__('The market prospection has been deleted.'));
        } else {
            $this->Flash->error(__('The market prospection could not be deleted. Please, try again.'));
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
        $marketProspection = $this->MarketProspections->newEmptyEntity();
        if ($this->request->is('post')) {
            $marketProspection = $this->MarketProspections->patchEntity($marketProspection, $this->request->getData());

            $marketProspection->createdby = $session->read('Auth.Username');
            $marketProspection->modifiedby = $session->read('Auth.Username');
            $marketProspection->deleted = 0;

            try{
                if ($this->MarketProspections->save($marketProspection)) {
                    $response = [
                        'message' => 'Data saved successfully!',
                        'data' => $marketProspection->toArray()
                    ];
                }else {
                    $errors = $marketProspection->getErrors();
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
