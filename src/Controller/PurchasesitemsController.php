<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Purchasesitems Controller
 *
 * @property \App\Model\Table\PurchasesitemsTable $Purchasesitems
 */
class PurchasesitemsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Purchasesitems->find()->where(['Purchasesitems.deleted' => 0])
            ->contain(['Purchases', 'Products']);
        $purchasesitems = $this->paginate($query);

        $this->set(compact('purchasesitems'));
    }

    /**
     * View method
     *
     * @param string|null $id Purchasesitem id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $purchasesitem = $this->Purchasesitems->get($id, contain: ['Purchases', 'Products']);
        $this->set(compact('purchasesitem'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $purchasesitem = $this->Purchasesitems->newEmptyEntity();
        if ($this->request->is('post')) {
            $purchasesitem = $this->Purchasesitems->patchEntity($purchasesitem, $this->request->getData());

            $purchasesitem->createdby = $session->read('Auth.Username');
            $purchasesitem->modifiedby = $session->read('Auth.Username');
            $purchasesitem->deleted = 0;

            if ($this->Purchasesitems->save($purchasesitem)) {
                $this->Flash->success(__('The purchasesitem has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchasesitem could not be saved. Please, try again.'));
        }
        $purchases = $this->Purchasesitems->Purchases->find('list', limit: 200)->all();
        $products = $this->Purchasesitems->Products->find('list', limit: 200)->all();
        $this->set(compact('purchasesitem', 'purchases', 'products'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Purchasesitem id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $purchasesitem = $this->Purchasesitems->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $purchasesitem = $this->Purchasesitems->patchEntity($purchasesitem, $this->request->getData());

            $purchasesitem->modifiedby = $session->read('Auth.Username');

            if ($this->Purchasesitems->save($purchasesitem)) {
                $this->Flash->success(__('The purchasesitem has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchasesitem could not be saved. Please, try again.'));
        }
        $purchases = $this->Purchasesitems->Purchases->find('list', limit: 200)->all();
        $products = $this->Purchasesitems->Products->find('list', limit: 200)->all();
        $this->set(compact('purchasesitem', 'purchases', 'products'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Purchasesitem id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $purchasesitem = $this->Purchasesitems->get($id);

        $purchasesitem->modifiedby = $session->read('Auth.Username');
        $purchasesitem->deleted = 0;

        if ($this->Purchasesitems->save($purchasesitem)) {
            $this->Flash->success(__('The purchasesitem has been deleted.'));
        } else {
            $this->Flash->error(__('The purchasesitem could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
