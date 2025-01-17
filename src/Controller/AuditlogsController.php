<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Auditlogs Controller
 *
 * @property \App\Model\Table\AuditlogsTable $Auditlogs
 */
class AuditlogsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Auditlogs->find()->where(['Auditlogs.deleted' => 0]);
        $auditlogs = $this->paginate($query);

        $this->set(compact('auditlogs'));
    }

    /**
     * View method
     *
     * @param string|null $id Auditlog id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $auditlog = $this->Auditlogs->get($id, contain: []);
        $this->set(compact('auditlog'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $auditlog = $this->Auditlogs->newEmptyEntity();
        if ($this->request->is('post')) {
            $auditlog = $this->Auditlogs->patchEntity($auditlog, $this->request->getData());

            $auditlog->createdby = $session->read('Auth.Username');
            $auditlog->modifiedby = $session->read('Auth.Username');
            $auditlog->deleted = 0;

            if ($this->Auditlogs->save($auditlog)) {
                $this->Flash->success(__('The auditlog has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The auditlog could not be saved. Please, try again.'));
        }
        $this->set(compact('auditlog'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Auditlog id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $auditlog = $this->Auditlogs->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $auditlog = $this->Auditlogs->patchEntity($auditlog, $this->request->getData());

            $auditlog->modifiedby = $session->read('Auth.Username');

            if ($this->Auditlogs->save($auditlog)) {
                $this->Flash->success(__('The auditlog has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The auditlog could not be saved. Please, try again.'));
        }
        $this->set(compact('auditlog'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Auditlog id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $auditlog = $this->Auditlogs->get($id);

        $auditlog->modifiedby = $session->read('Auth.Username');
        $auditlog->deleted = 0;

        if ($this->Auditlogs->save($auditlog)) {
            $this->Flash->success(__('The auditlog has been deleted.'));
        } else {
            $this->Flash->error(__('The auditlog could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
