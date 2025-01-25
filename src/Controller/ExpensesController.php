<?php
declare(strict_types=1);

namespace App\Controller;

use Exception;

/**
 * Expenses Controller
 *
 * @property \App\Model\Table\ExpensesTable $Expenses
 */
class ExpensesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Expenses->find()->where(['Expenses.deleted' => 0])
            ->contain(['Shops', 'Expensestypes']);
        $expenses = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $this->set(compact('expenses'));
    }

    /**
     * View method
     *
     * @param string|null $id Expense id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $expense = $this->Expenses->get($id, contain: ['Shops', 'Expensestypes']);
        $this->set(compact('expense'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $expense = $this->Expenses->newEmptyEntity();
        if ($this->request->is('post')) {
            $expense = $this->Expenses->patchEntity($expense, $this->request->getData());

            $expense->createdby = $session->read('Auth.Username');
            $expense->modifiedby = $session->read('Auth.Username');
            $expense->deleted = 0;

            if ($this->Expenses->save($expense)) {
                $this->Flash->success(__('The expense has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The expense could not be saved. Please, try again.'));
        }
        $shops = $this->Expenses->Shops->find('list', limit: 200)->all();
        $expensestypes = $this->Expenses->Expensestypes->find('list', limit: 200)->all();
        $this->set(compact('expense', 'shops', 'expensestypes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Expense id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $expense = $this->Expenses->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $expense = $this->Expenses->patchEntity($expense, $this->request->getData());

            $expense->modifiedby = $session->read('Auth.Username');

            if ($this->Expenses->save($expense)) {
                $this->Flash->success(__('The expense has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The expense could not be saved. Please, try again.'));
        }
        $shops = $this->Expenses->Shops->find('list', limit: 200)->all();
        $expensestypes = $this->Expenses->Expensestypes->find('list', limit: 200)->all();
        $this->set(compact('expense', 'shops', 'expensestypes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Expense id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $expense = $this->Expenses->get($id);

        $expense->modifiedby = $session->read('Auth.Username');
        $expense->deleted = 1;

        if ($this->Expenses->save($expense)) {
            $this->Flash->success(__('The expense has been deleted.'));
        } else {
            $this->Flash->error(__('The expense could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Insert method
     */
    public function insert()
    {
        $this->request->allowMethod(['ajax', 'post']);
        $session = $this->request->getSession();
        $expense = $this->Expenses->newEmptyEntity();
        if ($this->request->is('post')) {
            $expense = $this->Expenses->patchEntity($expense, $this->request->getData());

            $expense->createdby = $session->read('Auth.Username');
            $expense->modifiedby = $session->read('Auth.Username');
            $expense->deleted = 0;

            try{
                if ($this->Expenses->save($expense)) {
                    $response = [
                        'message' => 'Data saved successfully!',
                        'data' => $expense->toArray()
                    ];
                }else {
                    $errors = $expense->getErrors();
                    $response = ['message' => 'Failed to save data.', 'errors' => $errors];
                }
            }
            catch (Exception $e) {
                $response = ['message' => 'An error occurred: ' . $e->getMessage()];
            }
            // Set the response type to JSON
            $this->response = $this->response->withType('application/json');

            // Serialize the response to JSON
            $this->set(compact('response'));
            $this->set('_serialize', ['response']); // Automatically serializes the response variable as JSON

            // Ensure the response is sent as JSON (no need for a view)
            return $this->response->withStringBody(json_encode($response));
        }
    }
}
