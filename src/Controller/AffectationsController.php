<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Affectations Controller
 *
 * @property \App\Model\Table\AffectationsTable $Affectations
 */
class AffectationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Affectations->find()->where(['Affectations.deleted' => 0])
            ->contain(['Users', 'Profiles', 'Shops']);
        $affectations = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $this->set(compact('affectations'));
    }

    /**
     * View method
     *
     * @param string|null $id Affectation id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $affectation = $this->Affectations->get($id, contain: ['Users', 'Profiles', 'Shops', 'Attendances']);
        $this->set(compact('affectation'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $affectation = $this->Affectations->newEmptyEntity();
        if ($this->request->is('post')) {
            $affectation = $this->Affectations->patchEntity($affectation, $this->request->getData());

            $affectation->createdby = $session->read('Auth.Username');
            $affectation->modifiedby = $session->read('Auth.Username');
            $affectation->deleted = 0;

            if ($this->Affectations->save($affectation)) {
                $this->Flash->success(__('The affectation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The affectation could not be saved. Please, try again.'));
        }
        $users = $this->Affectations->Users->find('list', limit: 200)->all();
        $profiles = $this->Affectations->Profiles->find('list', limit: 200)->all();
        $shops = $this->Affectations->Shops->find('list', limit: 200)->all();
        $this->set(compact('affectation', 'users', 'profiles', 'shops'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Affectation id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $affectation = $this->Affectations->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $affectation = $this->Affectations->patchEntity($affectation, $this->request->getData());

            $affectation->modifiedby = $session->read('Auth.Username');

            if ($this->Affectations->save($affectation)) {
                $this->Flash->success(__('The affectation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The affectation could not be saved. Please, try again.'));
        }
        $users = $this->Affectations->Users->find('list', limit: 200)->all();
        $profiles = $this->Affectations->Profiles->find('list', limit: 200)->all();
        $shops = $this->Affectations->Shops->find('list', limit: 200)->all();
        $this->set(compact('affectation', 'users', 'profiles', 'shops'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Affectation id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $affectation = $this->Affectations->get($id);

        $affectation->modifiedby = $session->read('Auth.Username');
        $affectation->deleted = 0;

        if ($this->Affectations->save($affectation)) {
            $this->Flash->success(__('The affectation has been deleted.'));
        } else {
            $this->Flash->error(__('The affectation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
