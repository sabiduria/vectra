<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Accessrights Controller
 *
 * @property \App\Model\Table\AccessrightsTable $Accessrights
 */
class AccessrightsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Accessrights->find()->where(['Accessrights.deleted' => 0])
            ->contain(['Profiles', 'Resources']);
        $accessrights = $this->paginate($query);

        $this->set(compact('accessrights'));
    }

    /**
     * View method
     *
     * @param string|null $id Accessright id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $accessright = $this->Accessrights->get($id, contain: ['Profiles', 'Resources']);
        $this->set(compact('accessright'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $accessright = $this->Accessrights->newEmptyEntity();
        if ($this->request->is('post')) {
            $accessright = $this->Accessrights->patchEntity($accessright, $this->request->getData());

            $accessright->createdby = $session->read('Auth.Username');
            $accessright->modifiedby = $session->read('Auth.Username');
            $accessright->deleted = 0;

            if ($this->Accessrights->save($accessright)) {
                $this->Flash->success(__('The accessright has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The accessright could not be saved. Please, try again.'));
        }
        $profiles = $this->Accessrights->Profiles->find('list', limit: 200)->all();
        $resources = $this->Accessrights->Resources->find('list', limit: 200)->all();
        $this->set(compact('accessright', 'profiles', 'resources'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Accessright id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $accessright = $this->Accessrights->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $accessright = $this->Accessrights->patchEntity($accessright, $this->request->getData());

            $accessright->modifiedby = $session->read('Auth.Username');

            if ($this->Accessrights->save($accessright)) {
                $this->Flash->success(__('The accessright has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The accessright could not be saved. Please, try again.'));
        }
        $profiles = $this->Accessrights->Profiles->find('list', limit: 200)->all();
        $resources = $this->Accessrights->Resources->find('list', limit: 200)->all();
        $this->set(compact('accessright', 'profiles', 'resources'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Accessright id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $accessright = $this->Accessrights->get($id);

        $accessright->modifiedby = $session->read('Auth.Username');
        $accessright->deleted = 0;

        if ($this->Accessrights->save($accessright)) {
            $this->Flash->success(__('The accessright has been deleted.'));
        } else {
            $this->Flash->error(__('The accessright could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
