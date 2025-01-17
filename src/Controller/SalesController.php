<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Sales Controller
 *
 * @property \App\Model\Table\SalesTable $Sales
 */
class SalesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Sales->find()->where(['Sales.deleted' => 0])
            ->contain(['Users', 'Customers', 'Statuses']);
        $sales = $this->paginate($query);

        $this->set(compact('sales'));
    }

    /**
     * View method
     *
     * @param string|null $id Sale id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $sale = $this->Sales->get($id, contain: ['Users', 'Customers', 'Statuses', 'Salesitems']);
        $this->set(compact('sale'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $sale = $this->Sales->newEmptyEntity();
        if ($this->request->is('post')) {
            $sale = $this->Sales->patchEntity($sale, $this->request->getData());

            $sale->createdby = $session->read('Auth.Username');
            $sale->modifiedby = $session->read('Auth.Username');
            $sale->deleted = 0;

            if ($this->Sales->save($sale)) {
                $this->Flash->success(__('The sale has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sale could not be saved. Please, try again.'));
        }
        $users = $this->Sales->Users->find('list', limit: 200)->all();
        $customers = $this->Sales->Customers->find('list', limit: 200)->all();
        $statuses = $this->Sales->Statuses->find('list', limit: 200)->all();
        $this->set(compact('sale', 'users', 'customers', 'statuses'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sale id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $sale = $this->Sales->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sale = $this->Sales->patchEntity($sale, $this->request->getData());

            $sale->modifiedby = $session->read('Auth.Username');

            if ($this->Sales->save($sale)) {
                $this->Flash->success(__('The sale has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sale could not be saved. Please, try again.'));
        }
        $users = $this->Sales->Users->find('list', limit: 200)->all();
        $customers = $this->Sales->Customers->find('list', limit: 200)->all();
        $statuses = $this->Sales->Statuses->find('list', limit: 200)->all();
        $this->set(compact('sale', 'users', 'customers', 'statuses'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sale id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $sale = $this->Sales->get($id);

        $sale->modifiedby = $session->read('Auth.Username');
        $sale->deleted = 0;

        if ($this->Sales->save($sale)) {
            $this->Flash->success(__('The sale has been deleted.'));
        } else {
            $this->Flash->error(__('The sale could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
