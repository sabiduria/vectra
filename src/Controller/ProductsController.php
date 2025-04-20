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
            ->contain(['Suppliers', 'Categories', 'Packagings', 'Brands']);
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
        $product = $this->Products->get($id, contain: ['Suppliers', 'Categories', 'Packagings', 'Inventories', 'Ordersitems', 'Pricings', 'Promotionsproducts', 'Purchasesitems', 'Salesitems', 'Shopstocks', 'Spoilages', 'Stockinsdetails', 'Transfersdetails', 'Brands']);
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
        $filename = 'default_product.png';

        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->getData());

            /*8888888888888888888888888888888888888 -Image- 8888888888888888888888888888888888888888*/
            if (!empty($this->request->getData('image')->getClientFilename())) {
                $imageFile = $this->request->getData('image');
                $filename = uniqid() . '.' . pathinfo($imageFile->getClientFilename(), PATHINFO_EXTENSION);
                $uploadPath = WWW_ROOT . 'img' . DS;
                // Move uploaded file
                $imageFile->moveTo($uploadPath . $filename);
                // Save filename to database
                $product->image = $filename;
            }
            /*8888888888888888888888888888888888888 -Image- 8888888888888888888888888888888888888888*/

            $room_id = $this->request->getData('room_id');
            $packaging_id = $this->request->getData('packaging_id');
            $unit_price = $this->request->getData('unit_price');
            $wholesale_price = $this->request->getData('wholesale_price');
            $special_price = $this->request->getData('special_price');
            $stock = $this->request->getData('stock');
            $stock_min = $this->request->getData('stock_min');
            $stock_max = $this->request->getData('stock_max');
            $purchase_price = $this->request->getData('purchase_price');
            $tax = $this->request->getData('tax');
            $barcode = $this->request->getData('barcode');
            $qty = $this->request->getData('stock');
            $expiry_date = $this->request->getData('expiry_date');

            $username = $session->read('Auth.Username');
            $product->createdby = $session->read('Auth.Username');
            $product->modifiedby = $session->read('Auth.Username');
            $product->deleted = 0;

            if ($this->Products->save($product)) {

                $shop_id = GeneralController::getShopIdFromRoom($room_id);
                GeneralController::NewStockIns($shop_id, $username);
                GeneralController::NewPricings($barcode, $product->id, $packaging_id, $unit_price, $wholesale_price, $special_price, $username);
                GeneralController::NewShopStocks($product->id, $room_id, $stock, $stock_min, $stock_max, $username);
                GeneralController::NewStockInsDetails($product->id, $room_id, $purchase_price, $tax, $barcode, $qty, $expiry_date, $username);

                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'view', $product->id]);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $suppliers = $this->Products->Suppliers->find('list', limit: 200)->all();
        $categories = $this->Products->Categories->find('list', limit: 200)->all();
        $packagings = $this->Products->Packagings->find('list', limit: 200)->all();
        $brands = $this->Products->Brands->find('list', limit: 200)->all();
        $rooms = $this->fetchTable('Rooms')
            ->find('list', [
                'keyField' => 'id',
                'valueField' => function ($room) {
                    return $room->name . ' - ' . $room->shop->name;
                }
            ])
            ->contain(['Shops'])
            ->all();
        $this->set(compact('product', 'suppliers', 'categories', 'packagings', 'rooms', 'brands'));
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
            $data = $this->request->getData();

            // Handle Image Upload First
            $imageFile = $this->request->getUploadedFile('image'); // Correctly get the uploaded file
            if ($imageFile && $imageFile->getError() === UPLOAD_ERR_OK) {
                $filename = uniqid() . '.' . pathinfo($imageFile->getClientFilename(), PATHINFO_EXTENSION);
                $uploadPath = WWW_ROOT . 'img' . DS;
                $imageFile->moveTo($uploadPath . $filename);

                // Add filename to data array before patching entity
                $data['image'] = $filename;
            } else {
                // Preserve existing image if no new file is uploaded
                unset($data['image']);
            }

            // Remove file object from $data before patching entity
            unset($data['image_file']);

            // Patch entity
            $product = $this->Products->patchEntity($product, $data);

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
        $brands = $this->Products->Brands->find('list', limit: 200)->all();
        $this->set(compact('product', 'suppliers', 'categories', 'packagings', 'brands'));
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

    public function stats()
    {

    }

    public function import()
    {

    }
}
