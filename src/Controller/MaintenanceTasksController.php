<?php
declare(strict_types=1);

namespace App\Controller;

use Exception;

/**
 * MaintenanceTasks Controller
 *
 * @property \App\Model\Table\MaintenanceTasksTable $MaintenanceTasks
 */
class MaintenanceTasksController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->MaintenanceTasks->find()->where(['MaintenanceTasks.deleted' => 0])
            ->contain(['MaintenanceRecords']);
        $maintenanceTasks = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $this->set(compact('maintenanceTasks'));
    }

    /**
     * View method
     *
     * @param string|null $id Maintenance Task id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $maintenanceTask = $this->MaintenanceTasks->get($id, contain: ['MaintenanceRecords']);
        $this->set(compact('maintenanceTask'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $maintenanceTask = $this->MaintenanceTasks->newEmptyEntity();
        if ($this->request->is('post')) {
            $maintenanceTask = $this->MaintenanceTasks->patchEntity($maintenanceTask, $this->request->getData());

            $maintenanceTask->createdby = $session->read('Auth.Username');
            $maintenanceTask->modifiedby = $session->read('Auth.Username');
            $maintenanceTask->deleted = 0;

            if ($this->MaintenanceTasks->save($maintenanceTask)) {
                $this->Flash->success(__('The maintenance task has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The maintenance task could not be saved. Please, try again.'));
        }
        $maintenanceRecords = $this->MaintenanceTasks->MaintenanceRecords->find('list', limit: 200)->all();
        $this->set(compact('maintenanceTask', 'maintenanceRecords'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Maintenance Task id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $maintenanceTask = $this->MaintenanceTasks->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $maintenanceTask = $this->MaintenanceTasks->patchEntity($maintenanceTask, $this->request->getData());

            $maintenanceTask->modifiedby = $session->read('Auth.Username');

            if ($this->MaintenanceTasks->save($maintenanceTask)) {
                $this->Flash->success(__('The maintenance task has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The maintenance task could not be saved. Please, try again.'));
        }
        $maintenanceRecords = $this->MaintenanceTasks->MaintenanceRecords->find('list', limit: 200)->all();
        $this->set(compact('maintenanceTask', 'maintenanceRecords'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Maintenance Task id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $maintenanceTask = $this->MaintenanceTasks->get($id);

        $maintenanceTask->modifiedby = $session->read('Auth.Username');
        $maintenanceTask->deleted = 1;

        if ($this->MaintenanceTasks->save($maintenanceTask)) {
            $this->Flash->success(__('The maintenance task has been deleted.'));
        } else {
            $this->Flash->error(__('The maintenance task could not be deleted. Please, try again.'));
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
        $maintenanceTask = $this->MaintenanceTasks->newEmptyEntity();
        if ($this->request->is('post')) {
            $maintenanceTask = $this->MaintenanceTasks->patchEntity($maintenanceTask, $this->request->getData());

            $maintenanceTask->createdby = $session->read('Auth.Username');
            $maintenanceTask->modifiedby = $session->read('Auth.Username');
            $maintenanceTask->deleted = 0;

            try{
                if ($this->MaintenanceTasks->save($maintenanceTask)) {
                    $response = [
                        'message' => 'Data saved successfully!',
                        'data' => $maintenanceTask->toArray()
                    ];
                }else {
                    $errors = $maintenanceTask->getErrors();
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
