<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Pricings Controller
 *
 * @property \App\Model\Table\PricingsTable $Pricings
 */
class PricingsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Pricings->find()->where(['Pricings.deleted' => 0])
            ->contain(['Products', 'Packagings']);
        $pricings = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $this->set(compact('pricings'));
    }

    /**
     * View method
     *
     * @param string|null $id Pricing id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $pricing = $this->Pricings->get($id, contain: ['Products', 'Packagings']);
        $this->set(compact('pricing'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $pricing = $this->Pricings->newEmptyEntity();
        if ($this->request->is('post')) {
            $pricing = $this->Pricings->patchEntity($pricing, $this->request->getData());

            $pricing->createdby = $session->read('Auth.Username');
            $pricing->modifiedby = $session->read('Auth.Username');
            $pricing->deleted = 0;

            if ($this->Pricings->save($pricing)) {
                $this->Flash->success(__('The pricing has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pricing could not be saved. Please, try again.'));
        }
        $products = $this->Pricings->Products->find('list', limit: 200)->all();
        $packagings = $this->Pricings->Packagings->find('list', limit: 200)->all();
        $this->set(compact('pricing', 'products', 'packagings'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Pricing id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $pricing = $this->Pricings->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pricing = $this->Pricings->patchEntity($pricing, $this->request->getData());

            $pricing->modifiedby = $session->read('Auth.Username');

            if ($this->Pricings->save($pricing)) {
                $this->Flash->success(__('The pricing has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pricing could not be saved. Please, try again.'));
        }
        $products = $this->Pricings->Products->find('list', limit: 200)->all();
        $packagings = $this->Pricings->Packagings->find('list', limit: 200)->all();
        $this->set(compact('pricing', 'products', 'packagings'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Pricing id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $pricing = $this->Pricings->get($id);

        $pricing->modifiedby = $session->read('Auth.Username');
        $pricing->deleted = 0;

        if ($this->Pricings->save($pricing)) {
            $this->Flash->success(__('The pricing has been deleted.'));
        } else {
            $this->Flash->error(__('The pricing could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
