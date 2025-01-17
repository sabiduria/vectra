<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Spoilages Controller
 *
 * @property \App\Model\Table\SpoilagesTable $Spoilages
 */
class SpoilagesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Spoilages->find()->where(['Spoilages.deleted' => 0])
            ->contain(['Products']);
        $spoilages = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $this->set(compact('spoilages'));
    }

    /**
     * View method
     *
     * @param string|null $id Spoilage id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $spoilage = $this->Spoilages->get($id, contain: ['Products']);
        $this->set(compact('spoilage'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $spoilage = $this->Spoilages->newEmptyEntity();
        if ($this->request->is('post')) {
            $spoilage = $this->Spoilages->patchEntity($spoilage, $this->request->getData());

            $spoilage->createdby = $session->read('Auth.Username');
            $spoilage->modifiedby = $session->read('Auth.Username');
            $spoilage->deleted = 0;

            if ($this->Spoilages->save($spoilage)) {
                $this->Flash->success(__('The spoilage has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The spoilage could not be saved. Please, try again.'));
        }
        $products = $this->Spoilages->Products->find('list', limit: 200)->all();
        $this->set(compact('spoilage', 'products'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Spoilage id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $spoilage = $this->Spoilages->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $spoilage = $this->Spoilages->patchEntity($spoilage, $this->request->getData());

            $spoilage->modifiedby = $session->read('Auth.Username');

            if ($this->Spoilages->save($spoilage)) {
                $this->Flash->success(__('The spoilage has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The spoilage could not be saved. Please, try again.'));
        }
        $products = $this->Spoilages->Products->find('list', limit: 200)->all();
        $this->set(compact('spoilage', 'products'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Spoilage id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $spoilage = $this->Spoilages->get($id);

        $spoilage->modifiedby = $session->read('Auth.Username');
        $spoilage->deleted = 0;

        if ($this->Spoilages->save($spoilage)) {
            $this->Flash->success(__('The spoilage has been deleted.'));
        } else {
            $this->Flash->error(__('The spoilage could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
