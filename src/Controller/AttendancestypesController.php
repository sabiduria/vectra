<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Attendancestypes Controller
 *
 * @property \App\Model\Table\AttendancestypesTable $Attendancestypes
 */
class AttendancestypesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Attendancestypes->find()->where(['Attendancestypes.deleted' => 0]);
        $attendancestypes = $this->paginate($query);

        $this->set(compact('attendancestypes'));
    }

    /**
     * View method
     *
     * @param string|null $id Attendancestype id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $attendancestype = $this->Attendancestypes->get($id, contain: ['Attendances']);
        $this->set(compact('attendancestype'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $attendancestype = $this->Attendancestypes->newEmptyEntity();
        if ($this->request->is('post')) {
            $attendancestype = $this->Attendancestypes->patchEntity($attendancestype, $this->request->getData());

            $attendancestype->createdby = $session->read('Auth.Username');
            $attendancestype->modifiedby = $session->read('Auth.Username');
            $attendancestype->deleted = 0;

            if ($this->Attendancestypes->save($attendancestype)) {
                $this->Flash->success(__('The attendancestype has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The attendancestype could not be saved. Please, try again.'));
        }
        $this->set(compact('attendancestype'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Attendancestype id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $attendancestype = $this->Attendancestypes->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $attendancestype = $this->Attendancestypes->patchEntity($attendancestype, $this->request->getData());

            $attendancestype->modifiedby = $session->read('Auth.Username');

            if ($this->Attendancestypes->save($attendancestype)) {
                $this->Flash->success(__('The attendancestype has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The attendancestype could not be saved. Please, try again.'));
        }
        $this->set(compact('attendancestype'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Attendancestype id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $attendancestype = $this->Attendancestypes->get($id);

        $attendancestype->modifiedby = $session->read('Auth.Username');
        $attendancestype->deleted = 0;

        if ($this->Attendancestypes->save($attendancestype)) {
            $this->Flash->success(__('The attendancestype has been deleted.'));
        } else {
            $this->Flash->error(__('The attendancestype could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
