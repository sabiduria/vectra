<?php
declare(strict_types=1);

namespace App\Controller;

use Exception;

/**
 * PartsUseds Controller
 *
 * @property \App\Model\Table\PartsUsedsTable $PartsUseds
 */
class PartsUsedsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->PartsUseds->find()->where(['PartsUseds.deleted' => 0])
            ->contain(['MaintenanceRecords']);
        $partsUseds = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $this->set(compact('partsUseds'));
    }

    /**
     * View method
     *
     * @param string|null $id Parts Used id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $partsUsed = $this->PartsUseds->get($id, contain: ['MaintenanceRecords']);
        $this->set(compact('partsUsed'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $partsUsed = $this->PartsUseds->newEmptyEntity();
        if ($this->request->is('post')) {
            $partsUsed = $this->PartsUseds->patchEntity($partsUsed, $this->request->getData());

            $partsUsed->createdby = $session->read('Auth.Username');
            $partsUsed->modifiedby = $session->read('Auth.Username');
            $partsUsed->deleted = 0;

            if ($this->PartsUseds->save($partsUsed)) {
                $this->Flash->success(__('The parts used has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The parts used could not be saved. Please, try again.'));
        }
        $maintenanceRecords = $this->PartsUseds->MaintenanceRecords->find('list', limit: 200)->all();
        $this->set(compact('partsUsed', 'maintenanceRecords'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Parts Used id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $partsUsed = $this->PartsUseds->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $partsUsed = $this->PartsUseds->patchEntity($partsUsed, $this->request->getData());

            $partsUsed->modifiedby = $session->read('Auth.Username');

            if ($this->PartsUseds->save($partsUsed)) {
                $this->Flash->success(__('The parts used has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The parts used could not be saved. Please, try again.'));
        }
        $maintenanceRecords = $this->PartsUseds->MaintenanceRecords->find('list', limit: 200)->all();
        $this->set(compact('partsUsed', 'maintenanceRecords'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Parts Used id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $partsUsed = $this->PartsUseds->get($id);

        $partsUsed->modifiedby = $session->read('Auth.Username');
        $partsUsed->deleted = 1;

        if ($this->PartsUseds->save($partsUsed)) {
            $this->Flash->success(__('The parts used has been deleted.'));
        } else {
            $this->Flash->error(__('The parts used could not be deleted. Please, try again.'));
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
        $partsUsed = $this->PartsUseds->newEmptyEntity();
        if ($this->request->is('post')) {
            $partsUsed = $this->PartsUseds->patchEntity($partsUsed, $this->request->getData());

            $partsUsed->createdby = $session->read('Auth.Username');
            $partsUsed->modifiedby = $session->read('Auth.Username');
            $partsUsed->deleted = 0;

            try{
                if ($this->PartsUseds->save($partsUsed)) {
                    $response = [
                        'message' => 'Data saved successfully!',
                        'data' => $partsUsed->toArray()
                    ];
                }else {
                    $errors = $partsUsed->getErrors();
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
