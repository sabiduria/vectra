<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Ordersitems Controller
 *
 * @property \App\Model\Table\OrdersitemsTable $Ordersitems
 */
class OrdersitemsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Ordersitems->find()->where(['Ordersitems.deleted' => 0])
            ->contain(['Products', 'Orders']);
        $ordersitems = $this->paginate($query);

        $this->set(compact('ordersitems'));
    }

    /**
     * View method
     *
     * @param string|null $id Ordersitem id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ordersitem = $this->Ordersitems->get($id, contain: ['Products', 'Orders']);
        $this->set(compact('ordersitem'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $ordersitem = $this->Ordersitems->newEmptyEntity();
        if ($this->request->is('post')) {
            $ordersitem = $this->Ordersitems->patchEntity($ordersitem, $this->request->getData());

            $ordersitem->createdby = $session->read('Auth.Username');
            $ordersitem->modifiedby = $session->read('Auth.Username');
            $ordersitem->deleted = 0;

            if ($this->Ordersitems->save($ordersitem)) {
                $this->Flash->success(__('The ordersitem has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ordersitem could not be saved. Please, try again.'));
        }
        $products = $this->Ordersitems->Products->find('list', limit: 200)->all();
        $orders = $this->Ordersitems->Orders->find('list', limit: 200)->all();
        $this->set(compact('ordersitem', 'products', 'orders'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Ordersitem id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $ordersitem = $this->Ordersitems->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ordersitem = $this->Ordersitems->patchEntity($ordersitem, $this->request->getData());

            $ordersitem->modifiedby = $session->read('Auth.Username');

            if ($this->Ordersitems->save($ordersitem)) {
                $this->Flash->success(__('The ordersitem has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ordersitem could not be saved. Please, try again.'));
        }
        $products = $this->Ordersitems->Products->find('list', limit: 200)->all();
        $orders = $this->Ordersitems->Orders->find('list', limit: 200)->all();
        $this->set(compact('ordersitem', 'products', 'orders'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Ordersitem id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $ordersitem = $this->Ordersitems->get($id);

        $ordersitem->modifiedby = $session->read('Auth.Username');
        $ordersitem->deleted = 0;

        if ($this->Ordersitems->save($ordersitem)) {
            $this->Flash->success(__('The ordersitem has been deleted.'));
        } else {
            $this->Flash->error(__('The ordersitem could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
