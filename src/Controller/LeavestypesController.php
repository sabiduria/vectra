<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Leavestypes Controller
 *
 * @property \App\Model\Table\LeavestypesTable $Leavestypes
 */
class LeavestypesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Leavestypes->find()->where(['Leavestypes.deleted' => 0]);
        $leavestypes = $this->paginate($query);

        $this->set(compact('leavestypes'));
    }

    /**
     * View method
     *
     * @param string|null $id Leavestype id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $leavestype = $this->Leavestypes->get($id, contain: ['Leaves', 'Leavesbalances']);
        $this->set(compact('leavestype'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $leavestype = $this->Leavestypes->newEmptyEntity();
        if ($this->request->is('post')) {
            $leavestype = $this->Leavestypes->patchEntity($leavestype, $this->request->getData());

            $leavestype->createdby = $session->read('Auth.Username');
            $leavestype->modifiedby = $session->read('Auth.Username');
            $leavestype->deleted = 0;

            if ($this->Leavestypes->save($leavestype)) {
                $this->Flash->success(__('The leavestype has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The leavestype could not be saved. Please, try again.'));
        }
        $this->set(compact('leavestype'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Leavestype id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $leavestype = $this->Leavestypes->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $leavestype = $this->Leavestypes->patchEntity($leavestype, $this->request->getData());

            $leavestype->modifiedby = $session->read('Auth.Username');

            if ($this->Leavestypes->save($leavestype)) {
                $this->Flash->success(__('The leavestype has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The leavestype could not be saved. Please, try again.'));
        }
        $this->set(compact('leavestype'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Leavestype id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $leavestype = $this->Leavestypes->get($id);

        $leavestype->modifiedby = $session->read('Auth.Username');
        $leavestype->deleted = 0;

        if ($this->Leavestypes->save($leavestype)) {
            $this->Flash->success(__('The leavestype has been deleted.'));
        } else {
            $this->Flash->error(__('The leavestype could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
