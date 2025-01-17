<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Inventories Controller
 *
 * @property \App\Model\Table\InventoriesTable $Inventories
 */
class InventoriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Inventories->find()->where(['Inventories.deleted' => 0])
            ->contain(['Products']);
        $inventories = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $this->set(compact('inventories'));
    }

    /**
     * View method
     *
     * @param string|null $id Inventory id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $inventory = $this->Inventories->get($id, contain: ['Products']);
        $this->set(compact('inventory'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $inventory = $this->Inventories->newEmptyEntity();
        if ($this->request->is('post')) {
            $inventory = $this->Inventories->patchEntity($inventory, $this->request->getData());

            $inventory->createdby = $session->read('Auth.Username');
            $inventory->modifiedby = $session->read('Auth.Username');
            $inventory->deleted = 0;

            if ($this->Inventories->save($inventory)) {
                $this->Flash->success(__('The inventory has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The inventory could not be saved. Please, try again.'));
        }
        $products = $this->Inventories->Products->find('list', limit: 200)->all();
        $this->set(compact('inventory', 'products'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Inventory id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $inventory = $this->Inventories->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $inventory = $this->Inventories->patchEntity($inventory, $this->request->getData());

            $inventory->modifiedby = $session->read('Auth.Username');

            if ($this->Inventories->save($inventory)) {
                $this->Flash->success(__('The inventory has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The inventory could not be saved. Please, try again.'));
        }
        $products = $this->Inventories->Products->find('list', limit: 200)->all();
        $this->set(compact('inventory', 'products'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Inventory id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $inventory = $this->Inventories->get($id);

        $inventory->modifiedby = $session->read('Auth.Username');
        $inventory->deleted = 0;

        if ($this->Inventories->save($inventory)) {
            $this->Flash->success(__('The inventory has been deleted.'));
        } else {
            $this->Flash->error(__('The inventory could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
