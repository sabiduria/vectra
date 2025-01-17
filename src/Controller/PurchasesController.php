<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Purchases Controller
 *
 * @property \App\Model\Table\PurchasesTable $Purchases
 */
class PurchasesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Purchases->find()->where(['Purchases.deleted' => 0])
            ->contain(['Statuses', 'Suppliers']);
        $purchases = $this->paginate($query);

        $this->set(compact('purchases'));
    }

    /**
     * View method
     *
     * @param string|null $id Purchase id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $purchase = $this->Purchases->get($id, contain: ['Statuses', 'Suppliers', 'Paymentstosuppliers', 'Purchasesitems']);
        $this->set(compact('purchase'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $purchase = $this->Purchases->newEmptyEntity();
        if ($this->request->is('post')) {
            $purchase = $this->Purchases->patchEntity($purchase, $this->request->getData());

            $purchase->createdby = $session->read('Auth.Username');
            $purchase->modifiedby = $session->read('Auth.Username');
            $purchase->deleted = 0;

            if ($this->Purchases->save($purchase)) {
                $this->Flash->success(__('The purchase has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase could not be saved. Please, try again.'));
        }
        $statuses = $this->Purchases->Statuses->find('list', limit: 200)->all();
        $suppliers = $this->Purchases->Suppliers->find('list', limit: 200)->all();
        $this->set(compact('purchase', 'statuses', 'suppliers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Purchase id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $purchase = $this->Purchases->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $purchase = $this->Purchases->patchEntity($purchase, $this->request->getData());

            $purchase->modifiedby = $session->read('Auth.Username');

            if ($this->Purchases->save($purchase)) {
                $this->Flash->success(__('The purchase has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase could not be saved. Please, try again.'));
        }
        $statuses = $this->Purchases->Statuses->find('list', limit: 200)->all();
        $suppliers = $this->Purchases->Suppliers->find('list', limit: 200)->all();
        $this->set(compact('purchase', 'statuses', 'suppliers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Purchase id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $purchase = $this->Purchases->get($id);

        $purchase->modifiedby = $session->read('Auth.Username');
        $purchase->deleted = 0;

        if ($this->Purchases->save($purchase)) {
            $this->Flash->success(__('The purchase has been deleted.'));
        } else {
            $this->Flash->error(__('The purchase could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
