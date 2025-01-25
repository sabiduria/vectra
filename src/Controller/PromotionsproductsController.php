<?php
declare(strict_types=1);

namespace App\Controller;

use Exception;

/**
 * Promotionsproducts Controller
 *
 * @property \App\Model\Table\PromotionsproductsTable $Promotionsproducts
 */
class PromotionsproductsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Promotionsproducts->find()->where(['Promotionsproducts.deleted' => 0])
            ->contain(['Products']);
        $promotionsproducts = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $this->set(compact('promotionsproducts'));
    }

    /**
     * View method
     *
     * @param string|null $id Promotionsproduct id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $promotionsproduct = $this->Promotionsproducts->get($id, contain: ['Products']);
        $this->set(compact('promotionsproduct'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $promotionsproduct = $this->Promotionsproducts->newEmptyEntity();
        if ($this->request->is('post')) {
            $promotionsproduct = $this->Promotionsproducts->patchEntity($promotionsproduct, $this->request->getData());

            $promotionsproduct->createdby = $session->read('Auth.Username');
            $promotionsproduct->modifiedby = $session->read('Auth.Username');
            $promotionsproduct->deleted = 0;

            if ($this->Promotionsproducts->save($promotionsproduct)) {
                $this->Flash->success(__('The promotionsproduct has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The promotionsproduct could not be saved. Please, try again.'));
        }
        $products = $this->Promotionsproducts->Products->find('list', limit: 200)->all();
        $this->set(compact('promotionsproduct', 'products'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Promotionsproduct id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $promotionsproduct = $this->Promotionsproducts->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $promotionsproduct = $this->Promotionsproducts->patchEntity($promotionsproduct, $this->request->getData());

            $promotionsproduct->modifiedby = $session->read('Auth.Username');

            if ($this->Promotionsproducts->save($promotionsproduct)) {
                $this->Flash->success(__('The promotionsproduct has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The promotionsproduct could not be saved. Please, try again.'));
        }
        $products = $this->Promotionsproducts->Products->find('list', limit: 200)->all();
        $this->set(compact('promotionsproduct', 'products'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Promotionsproduct id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $promotionsproduct = $this->Promotionsproducts->get($id);

        $promotionsproduct->modifiedby = $session->read('Auth.Username');
        $promotionsproduct->deleted = 1;

        if ($this->Promotionsproducts->save($promotionsproduct)) {
            $this->Flash->success(__('The promotionsproduct has been deleted.'));
        } else {
            $this->Flash->error(__('The promotionsproduct could not be deleted. Please, try again.'));
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
        $promotionsproduct = $this->Promotionsproducts->newEmptyEntity();
        if ($this->request->is('post')) {
            $promotionsproduct = $this->Promotionsproducts->patchEntity($promotionsproduct, $this->request->getData());

            $promotionsproduct->createdby = $session->read('Auth.Username');
            $promotionsproduct->modifiedby = $session->read('Auth.Username');
            $promotionsproduct->deleted = 0;

            try{
                if ($this->Promotionsproducts->save($promotionsproduct)) {
                    $response = [
                        'message' => 'Data saved successfully!',
                        'data' => $promotionsproduct->toArray()
                    ];
                }else {
                    $errors = $promotionsproduct->getErrors();
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
