<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Shops Controller
 *
 * @property \App\Model\Table\ShopsTable $Shops
 */
class ShopsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Shops->find()->where(['Shops.deleted' => 0])
            ->contain(['Areas']);
        $shops = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $this->set(compact('shops'));
    }

    /**
     * View method
     *
     * @param string|null $id Shop id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $shop = $this->Shops->get($id, contain: ['Areas', 'Affectations', 'Expenses', 'Stockins', 'Transfers']);
        $this->set(compact('shop'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $shop = $this->Shops->newEmptyEntity();
        if ($this->request->is('post')) {
            $shop = $this->Shops->patchEntity($shop, $this->request->getData());

            $shop->createdby = $session->read('Auth.Username');
            $shop->modifiedby = $session->read('Auth.Username');
            $shop->deleted = 0;

            if ($this->Shops->save($shop)) {
                $this->Flash->success(__('The shop has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The shop could not be saved. Please, try again.'));
        }
        $areas = $this->Shops->Areas->find('list', limit: 200)->all();
        $this->set(compact('shop', 'areas'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Shop id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $shop = $this->Shops->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $shop = $this->Shops->patchEntity($shop, $this->request->getData());

            $shop->modifiedby = $session->read('Auth.Username');

            if ($this->Shops->save($shop)) {
                $this->Flash->success(__('The shop has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The shop could not be saved. Please, try again.'));
        }
        $areas = $this->Shops->Areas->find('list', limit: 200)->all();
        $this->set(compact('shop', 'areas'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Shop id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $shop = $this->Shops->get($id);

        $shop->modifiedby = $session->read('Auth.Username');
        $shop->deleted = 0;

        if ($this->Shops->save($shop)) {
            $this->Flash->success(__('The shop has been deleted.'));
        } else {
            $this->Flash->error(__('The shop could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
