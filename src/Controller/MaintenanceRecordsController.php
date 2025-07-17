<?php
declare(strict_types=1);

namespace App\Controller;

use Exception;

/**
 * MaintenanceRecords Controller
 *
 * @property \App\Model\Table\MaintenanceRecordsTable $MaintenanceRecords
 */
class MaintenanceRecordsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->MaintenanceRecords->find()->where(['MaintenanceRecords.deleted' => 0])
            ->contain(['Equipments']);
        $maintenanceRecords = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $this->set(compact('maintenanceRecords'));
    }

    /**
     * View method
     *
     * @param string|null $id Maintenance Record id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $maintenanceRecord = $this->MaintenanceRecords->get($id, contain: ['Equipments', 'MaintenanceTasks', 'PartsUseds']);
        $this->set(compact('maintenanceRecord'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $maintenanceRecord = $this->MaintenanceRecords->newEmptyEntity();
        if ($this->request->is('post')) {
            $maintenanceRecord = $this->MaintenanceRecords->patchEntity($maintenanceRecord, $this->request->getData());

            $maintenanceRecord->createdby = $session->read('Auth.Username');
            $maintenanceRecord->modifiedby = $session->read('Auth.Username');
            $maintenanceRecord->deleted = 0;

            if ($this->MaintenanceRecords->save($maintenanceRecord)) {
                $this->Flash->success(__('The maintenance record has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The maintenance record could not be saved. Please, try again.'));
        }
        $equipments = $this->MaintenanceRecords->Equipments->find('list', limit: 200)->all();
        $this->set(compact('maintenanceRecord', 'equipments'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Maintenance Record id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $maintenanceRecord = $this->MaintenanceRecords->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $maintenanceRecord = $this->MaintenanceRecords->patchEntity($maintenanceRecord, $this->request->getData());

            $maintenanceRecord->modifiedby = $session->read('Auth.Username');

            if ($this->MaintenanceRecords->save($maintenanceRecord)) {
                $this->Flash->success(__('The maintenance record has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The maintenance record could not be saved. Please, try again.'));
        }
        $equipments = $this->MaintenanceRecords->Equipments->find('list', limit: 200)->all();
        $this->set(compact('maintenanceRecord', 'equipments'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Maintenance Record id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $maintenanceRecord = $this->MaintenanceRecords->get($id);

        $maintenanceRecord->modifiedby = $session->read('Auth.Username');
        $maintenanceRecord->deleted = 1;

        if ($this->MaintenanceRecords->save($maintenanceRecord)) {
            $this->Flash->success(__('The maintenance record has been deleted.'));
        } else {
            $this->Flash->error(__('The maintenance record could not be deleted. Please, try again.'));
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
        $maintenanceRecord = $this->MaintenanceRecords->newEmptyEntity();
        if ($this->request->is('post')) {
            $maintenanceRecord = $this->MaintenanceRecords->patchEntity($maintenanceRecord, $this->request->getData());

            $maintenanceRecord->createdby = $session->read('Auth.Username');
            $maintenanceRecord->modifiedby = $session->read('Auth.Username');
            $maintenanceRecord->deleted = 0;

            try{
                if ($this->MaintenanceRecords->save($maintenanceRecord)) {
                    $response = [
                        'message' => 'Data saved successfully!',
                        'data' => $maintenanceRecord->toArray()
                    ];
                }else {
                    $errors = $maintenanceRecord->getErrors();
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
