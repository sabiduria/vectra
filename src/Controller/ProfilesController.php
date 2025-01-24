<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Profiles Controller
 *
 * @property \App\Model\Table\ProfilesTable $Profiles
 */
class ProfilesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Profiles->find()->where(['Profiles.deleted' => 0]);
        $profiles = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $this->set(compact('profiles'));
    }

    /**
     * View method
     *
     * @param string|null $id Profile id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $profile = $this->Profiles->get($id, contain: ['Accessrights', 'Affectations']);
        $this->set(compact('profile'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $profile = $this->Profiles->newEmptyEntity();
        if ($this->request->is('post')) {
            $profile = $this->Profiles->patchEntity($profile, $this->request->getData());

            $profile->createdby = $session->read('Auth.Username');
            $profile->modifiedby = $session->read('Auth.Username');
            $profile->deleted = 0;

            if ($this->Profiles->save($profile)) {
                $this->Flash->success(__('The profile has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The profile could not be saved. Please, try again.'));
        }
        $this->set(compact('profile'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Profile id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $profile = $this->Profiles->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $profile = $this->Profiles->patchEntity($profile, $this->request->getData());

            $profile->modifiedby = $session->read('Auth.Username');

            if ($this->Profiles->save($profile)) {
                $this->Flash->success(__('The profile has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The profile could not be saved. Please, try again.'));
        }
        $this->set(compact('profile'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Profile id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $profile = $this->Profiles->get($id);

        $profile->modifiedby = $session->read('Auth.Username');
        $profile->deleted = 1;

        if ($this->Profiles->save($profile)) {
            $this->Flash->success(__('The profile has been deleted.'));
        } else {
            $this->Flash->error(__('The profile could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
