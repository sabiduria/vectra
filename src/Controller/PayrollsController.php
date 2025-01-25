<?php
declare(strict_types=1);

namespace App\Controller;

use Exception;

/**
 * Payrolls Controller
 *
 * @property \App\Model\Table\PayrollsTable $Payrolls
 */
class PayrollsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Payrolls->find()->where(['Payrolls.deleted' => 0])
            ->contain(['Salaries']);
        $payrolls = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $this->set(compact('payrolls'));
    }

    /**
     * View method
     *
     * @param string|null $id Payroll id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $payroll = $this->Payrolls->get($id, contain: ['Salaries']);
        $this->set(compact('payroll'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $payroll = $this->Payrolls->newEmptyEntity();
        if ($this->request->is('post')) {
            $payroll = $this->Payrolls->patchEntity($payroll, $this->request->getData());

            $payroll->createdby = $session->read('Auth.Username');
            $payroll->modifiedby = $session->read('Auth.Username');
            $payroll->deleted = 0;

            if ($this->Payrolls->save($payroll)) {
                $this->Flash->success(__('The payroll has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The payroll could not be saved. Please, try again.'));
        }
        $salaries = $this->Payrolls->Salaries->find('list', limit: 200)->all();
        $this->set(compact('payroll', 'salaries'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Payroll id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $payroll = $this->Payrolls->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $payroll = $this->Payrolls->patchEntity($payroll, $this->request->getData());

            $payroll->modifiedby = $session->read('Auth.Username');

            if ($this->Payrolls->save($payroll)) {
                $this->Flash->success(__('The payroll has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The payroll could not be saved. Please, try again.'));
        }
        $salaries = $this->Payrolls->Salaries->find('list', limit: 200)->all();
        $this->set(compact('payroll', 'salaries'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Payroll id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $payroll = $this->Payrolls->get($id);

        $payroll->modifiedby = $session->read('Auth.Username');
        $payroll->deleted = 1;

        if ($this->Payrolls->save($payroll)) {
            $this->Flash->success(__('The payroll has been deleted.'));
        } else {
            $this->Flash->error(__('The payroll could not be deleted. Please, try again.'));
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
        $payroll = $this->Payrolls->newEmptyEntity();
        if ($this->request->is('post')) {
            $payroll = $this->Payrolls->patchEntity($payroll, $this->request->getData());

            $payroll->createdby = $session->read('Auth.Username');
            $payroll->modifiedby = $session->read('Auth.Username');
            $payroll->deleted = 0;

            try{
                if ($this->Payrolls->save($payroll)) {
                    $response = [
                        'message' => 'Data saved successfully!',
                        'data' => $payroll->toArray()
                    ];
                }else {
                    $errors = $payroll->getErrors();
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
