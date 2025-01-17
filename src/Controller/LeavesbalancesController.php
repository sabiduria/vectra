<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Leavesbalances Controller
 *
 * @property \App\Model\Table\LeavesbalancesTable $Leavesbalances
 */
class LeavesbalancesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Leavesbalances->find()->where(['Leavesbalances.deleted' => 0])
            ->contain(['Users', 'Leavestypes']);
        $leavesbalances = $this->paginate($query);

        $this->set(compact('leavesbalances'));
    }

    /**
     * View method
     *
     * @param string|null $id Leavesbalance id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $leavesbalance = $this->Leavesbalances->get($id, contain: ['Users', 'Leavestypes']);
        $this->set(compact('leavesbalance'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $leavesbalance = $this->Leavesbalances->newEmptyEntity();
        if ($this->request->is('post')) {
            $leavesbalance = $this->Leavesbalances->patchEntity($leavesbalance, $this->request->getData());

            $leavesbalance->createdby = $session->read('Auth.Username');
            $leavesbalance->modifiedby = $session->read('Auth.Username');
            $leavesbalance->deleted = 0;

            if ($this->Leavesbalances->save($leavesbalance)) {
                $this->Flash->success(__('The leavesbalance has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The leavesbalance could not be saved. Please, try again.'));
        }
        $users = $this->Leavesbalances->Users->find('list', limit: 200)->all();
        $leavestypes = $this->Leavesbalances->Leavestypes->find('list', limit: 200)->all();
        $this->set(compact('leavesbalance', 'users', 'leavestypes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Leavesbalance id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $leavesbalance = $this->Leavesbalances->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $leavesbalance = $this->Leavesbalances->patchEntity($leavesbalance, $this->request->getData());

            $leavesbalance->modifiedby = $session->read('Auth.Username');

            if ($this->Leavesbalances->save($leavesbalance)) {
                $this->Flash->success(__('The leavesbalance has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The leavesbalance could not be saved. Please, try again.'));
        }
        $users = $this->Leavesbalances->Users->find('list', limit: 200)->all();
        $leavestypes = $this->Leavesbalances->Leavestypes->find('list', limit: 200)->all();
        $this->set(compact('leavesbalance', 'users', 'leavestypes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Leavesbalance id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $leavesbalance = $this->Leavesbalances->get($id);

        $leavesbalance->modifiedby = $session->read('Auth.Username');
        $leavesbalance->deleted = 0;

        if ($this->Leavesbalances->save($leavesbalance)) {
            $this->Flash->success(__('The leavesbalance has been deleted.'));
        } else {
            $this->Flash->error(__('The leavesbalance could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
