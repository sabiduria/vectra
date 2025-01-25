<?php
declare(strict_types=1);

namespace App\Controller;

use Exception;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 */
class ProductsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Products->find()->where(['Products.deleted' => 0])
            ->contain(['Suppliers', 'Categories', 'Packagings']);
        $products = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $this->set(compact('products'));
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $product = $this->Products->get($id, contain: ['Suppliers', 'Categories', 'Packagings', 'Inventories', 'Ordersitems', 'Pricings', 'Promotionsproducts', 'Purchasesitems', 'Salesitems', 'Shopstocks', 'Spoilages', 'Stockinsdetails', 'Transfersdetails']);
        $this->set(compact('product'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $product = $this->Products->newEmptyEntity();
        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->getData());

            $product->createdby = $session->read('Auth.Username');
            $product->modifiedby = $session->read('Auth.Username');
            $product->deleted = 0;

            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $suppliers = $this->Products->Suppliers->find('list', limit: 200)->all();
        $categories = $this->Products->Categories->find('list', limit: 200)->all();
        $packagings = $this->Products->Packagings->find('list', limit: 200)->all();
        $this->set(compact('product', 'suppliers', 'categories', 'packagings'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $product = $this->Products->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->getData());

            $product->modifiedby = $session->read('Auth.Username');

            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $suppliers = $this->Products->Suppliers->find('list', limit: 200)->all();
        $categories = $this->Products->Categories->find('list', limit: 200)->all();
        $packagings = $this->Products->Packagings->find('list', limit: 200)->all();
        $this->set(compact('product', 'suppliers', 'categories', 'packagings'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);

        $product->modifiedby = $session->read('Auth.Username');
        $product->deleted = 1;

        if ($this->Products->save($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
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
        $product = $this->Products->newEmptyEntity();
        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->getData());

            $product->createdby = $session->read('Auth.Username');
            $product->modifiedby = $session->read('Auth.Username');
            $product->deleted = 0;

            try{
                if ($this->Products->save($product)) {
                    $response = [
                        'message' => 'Data saved successfully!',
                        'data' => $product->toArray()
                    ];
                }else {
                    $errors = $product->getErrors();
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
