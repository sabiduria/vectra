<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Expensestypes Controller
 *
 * @property \App\Model\Table\ExpensestypesTable $Expensestypes
 */
class ExpensestypesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Expensestypes->find()->where(['Expensestypes.deleted' => 0]);
        $expensestypes = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $this->set(compact('expensestypes'));
    }

    /**
     * View method
     *
     * @param string|null $id Expensestype id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $expensestype = $this->Expensestypes->get($id, contain: ['Expenses']);
        $this->set(compact('expensestype'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $expensestype = $this->Expensestypes->newEmptyEntity();
        if ($this->request->is('post')) {
            $expensestype = $this->Expensestypes->patchEntity($expensestype, $this->request->getData());

            $expensestype->createdby = $session->read('Auth.Username');
            $expensestype->modifiedby = $session->read('Auth.Username');
            $expensestype->deleted = 0;

            if ($this->Expensestypes->save($expensestype)) {
                $this->Flash->success(__('The expensestype has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The expensestype could not be saved. Please, try again.'));
        }
        $this->set(compact('expensestype'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Expensestype id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $expensestype = $this->Expensestypes->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $expensestype = $this->Expensestypes->patchEntity($expensestype, $this->request->getData());

            $expensestype->modifiedby = $session->read('Auth.Username');

            if ($this->Expensestypes->save($expensestype)) {
                $this->Flash->success(__('The expensestype has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The expensestype could not be saved. Please, try again.'));
        }
        $this->set(compact('expensestype'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Expensestype id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $expensestype = $this->Expensestypes->get($id);

        $expensestype->modifiedby = $session->read('Auth.Username');
        $expensestype->deleted = 0;

        if ($this->Expensestypes->save($expensestype)) {
            $this->Flash->success(__('The expensestype has been deleted.'));
        } else {
            $this->Flash->error(__('The expensestype could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
