<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Salaries Controller
 *
 * @property \App\Model\Table\SalariesTable $Salaries
 */
class SalariesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Salaries->find()->where(['Salaries.deleted' => 0])
            ->contain(['Users']);
        $salaries = $this->paginate($query);

        $this->set(compact('salaries'));
    }

    /**
     * View method
     *
     * @param string|null $id Salary id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $salary = $this->Salaries->get($id, contain: ['Users', 'Payrolls']);
        $this->set(compact('salary'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $salary = $this->Salaries->newEmptyEntity();
        if ($this->request->is('post')) {
            $salary = $this->Salaries->patchEntity($salary, $this->request->getData());

            $salary->createdby = $session->read('Auth.Username');
            $salary->modifiedby = $session->read('Auth.Username');
            $salary->deleted = 0;

            if ($this->Salaries->save($salary)) {
                $this->Flash->success(__('The salary has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The salary could not be saved. Please, try again.'));
        }
        $users = $this->Salaries->Users->find('list', limit: 200)->all();
        $this->set(compact('salary', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Salary id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $salary = $this->Salaries->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $salary = $this->Salaries->patchEntity($salary, $this->request->getData());

            $salary->modifiedby = $session->read('Auth.Username');

            if ($this->Salaries->save($salary)) {
                $this->Flash->success(__('The salary has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The salary could not be saved. Please, try again.'));
        }
        $users = $this->Salaries->Users->find('list', limit: 200)->all();
        $this->set(compact('salary', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Salary id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $salary = $this->Salaries->get($id);

        $salary->modifiedby = $session->read('Auth.Username');
        $salary->deleted = 0;

        if ($this->Salaries->save($salary)) {
            $this->Flash->success(__('The salary has been deleted.'));
        } else {
            $this->Flash->error(__('The salary could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
