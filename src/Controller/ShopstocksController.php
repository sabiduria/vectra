<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Shopstocks Controller
 *
 * @property \App\Model\Table\ShopstocksTable $Shopstocks
 */
class ShopstocksController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Shopstocks->find()->where(['Shopstocks.deleted' => 0])
            ->contain(['Shops', 'Products', 'Rooms']);
        $shopstocks = $this->paginate($query);

        $this->set(compact('shopstocks'));
    }

    /**
     * View method
     *
     * @param string|null $id Shopstock id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $shopstock = $this->Shopstocks->get($id, contain: ['Shops', 'Products', 'Rooms']);
        $this->set(compact('shopstock'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $shopstock = $this->Shopstocks->newEmptyEntity();
        if ($this->request->is('post')) {
            $shopstock = $this->Shopstocks->patchEntity($shopstock, $this->request->getData());

            $shopstock->createdby = $session->read('Auth.Username');
            $shopstock->modifiedby = $session->read('Auth.Username');
            $shopstock->deleted = 0;

            if ($this->Shopstocks->save($shopstock)) {
                $this->Flash->success(__('The shopstock has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The shopstock could not be saved. Please, try again.'));
        }
        $shops = $this->Shopstocks->Shops->find('list', limit: 200)->all();
        $products = $this->Shopstocks->Products->find('list', limit: 200)->all();
        $rooms = $this->Shopstocks->Rooms->find('list', limit: 200)->all();
        $this->set(compact('shopstock', 'shops', 'products', 'rooms'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Shopstock id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $shopstock = $this->Shopstocks->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $shopstock = $this->Shopstocks->patchEntity($shopstock, $this->request->getData());

            $shopstock->modifiedby = $session->read('Auth.Username');

            if ($this->Shopstocks->save($shopstock)) {
                $this->Flash->success(__('The shopstock has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The shopstock could not be saved. Please, try again.'));
        }
        $shops = $this->Shopstocks->Shops->find('list', limit: 200)->all();
        $products = $this->Shopstocks->Products->find('list', limit: 200)->all();
        $rooms = $this->Shopstocks->Rooms->find('list', limit: 200)->all();
        $this->set(compact('shopstock', 'shops', 'products', 'rooms'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Shopstock id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $shopstock = $this->Shopstocks->get($id);

        $shopstock->modifiedby = $session->read('Auth.Username');
        $shopstock->deleted = 0;

        if ($this->Shopstocks->save($shopstock)) {
            $this->Flash->success(__('The shopstock has been deleted.'));
        } else {
            $this->Flash->error(__('The shopstock could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
