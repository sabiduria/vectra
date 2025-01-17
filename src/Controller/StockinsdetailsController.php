<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Stockinsdetails Controller
 *
 * @property \App\Model\Table\StockinsdetailsTable $Stockinsdetails
 */
class StockinsdetailsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Stockinsdetails->find()->where(['Stockinsdetails.deleted' => 0])
            ->contain(['Products', 'Stockins']);
        $stockinsdetails = $this->paginate($query);

        $this->set(compact('stockinsdetails'));
    }

    /**
     * View method
     *
     * @param string|null $id Stockinsdetail id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $stockinsdetail = $this->Stockinsdetails->get($id, contain: ['Products', 'Stockins']);
        $this->set(compact('stockinsdetail'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $stockinsdetail = $this->Stockinsdetails->newEmptyEntity();
        if ($this->request->is('post')) {
            $stockinsdetail = $this->Stockinsdetails->patchEntity($stockinsdetail, $this->request->getData());

            $stockinsdetail->createdby = $session->read('Auth.Username');
            $stockinsdetail->modifiedby = $session->read('Auth.Username');
            $stockinsdetail->deleted = 0;

            if ($this->Stockinsdetails->save($stockinsdetail)) {
                $this->Flash->success(__('The stockinsdetail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The stockinsdetail could not be saved. Please, try again.'));
        }
        $products = $this->Stockinsdetails->Products->find('list', limit: 200)->all();
        $stockins = $this->Stockinsdetails->Stockins->find('list', limit: 200)->all();
        $this->set(compact('stockinsdetail', 'products', 'stockins'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Stockinsdetail id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $stockinsdetail = $this->Stockinsdetails->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $stockinsdetail = $this->Stockinsdetails->patchEntity($stockinsdetail, $this->request->getData());

            $stockinsdetail->modifiedby = $session->read('Auth.Username');

            if ($this->Stockinsdetails->save($stockinsdetail)) {
                $this->Flash->success(__('The stockinsdetail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The stockinsdetail could not be saved. Please, try again.'));
        }
        $products = $this->Stockinsdetails->Products->find('list', limit: 200)->all();
        $stockins = $this->Stockinsdetails->Stockins->find('list', limit: 200)->all();
        $this->set(compact('stockinsdetail', 'products', 'stockins'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Stockinsdetail id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $stockinsdetail = $this->Stockinsdetails->get($id);

        $stockinsdetail->modifiedby = $session->read('Auth.Username');
        $stockinsdetail->deleted = 0;

        if ($this->Stockinsdetails->save($stockinsdetail)) {
            $this->Flash->success(__('The stockinsdetail has been deleted.'));
        } else {
            $this->Flash->error(__('The stockinsdetail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
