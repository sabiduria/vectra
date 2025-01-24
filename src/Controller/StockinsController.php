<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Stockins Controller
 *
 * @property \App\Model\Table\StockinsTable $Stockins
 */
class StockinsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Stockins->find()->where(['Stockins.deleted' => 0])
            ->contain(['Shops']);
        $stockins = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $this->set(compact('stockins'));
    }

    /**
     * View method
     *
     * @param string|null $id Stockin id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $stockin = $this->Stockins->get($id, contain: ['Shops', 'Stockinsdetails']);
        $this->set(compact('stockin'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $stockin = $this->Stockins->newEmptyEntity();
        if ($this->request->is('post')) {
            $stockin = $this->Stockins->patchEntity($stockin, $this->request->getData());

            $stockin->createdby = $session->read('Auth.Username');
            $stockin->modifiedby = $session->read('Auth.Username');
            $stockin->deleted = 0;

            if ($this->Stockins->save($stockin)) {
                $this->Flash->success(__('The stockin has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The stockin could not be saved. Please, try again.'));
        }
        $shops = $this->Stockins->Shops->find('list', limit: 200)->all();
        $this->set(compact('stockin', 'shops'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Stockin id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $stockin = $this->Stockins->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $stockin = $this->Stockins->patchEntity($stockin, $this->request->getData());

            $stockin->modifiedby = $session->read('Auth.Username');

            if ($this->Stockins->save($stockin)) {
                $this->Flash->success(__('The stockin has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The stockin could not be saved. Please, try again.'));
        }
        $shops = $this->Stockins->Shops->find('list', limit: 200)->all();
        $this->set(compact('stockin', 'shops'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Stockin id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $stockin = $this->Stockins->get($id);

        $stockin->modifiedby = $session->read('Auth.Username');
        $stockin->deleted = 1;

        if ($this->Stockins->save($stockin)) {
            $this->Flash->success(__('The stockin has been deleted.'));
        } else {
            $this->Flash->error(__('The stockin could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
