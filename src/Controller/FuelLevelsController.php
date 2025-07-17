<?php
declare(strict_types=1);

namespace App\Controller;

use Exception;

/**
 * FuelLevels Controller
 *
 * @property \App\Model\Table\FuelLevelsTable $FuelLevels
 */
class FuelLevelsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->FuelLevels->find()->where(['FuelLevels.deleted' => 0])
            ->contain(['Equipments']);
        $fuelLevels = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $this->set(compact('fuelLevels'));
    }

    /**
     * View method
     *
     * @param string|null $id Fuel Level id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $fuelLevel = $this->FuelLevels->get($id, contain: ['Equipments']);
        $this->set(compact('fuelLevel'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $fuelLevel = $this->FuelLevels->newEmptyEntity();
        if ($this->request->is('post')) {
            $fuelLevel = $this->FuelLevels->patchEntity($fuelLevel, $this->request->getData());

            $fuelLevel->createdby = $session->read('Auth.Username');
            $fuelLevel->modifiedby = $session->read('Auth.Username');
            $fuelLevel->deleted = 0;

            if ($this->FuelLevels->save($fuelLevel)) {
                $this->Flash->success(__('The fuel level has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fuel level could not be saved. Please, try again.'));
        }
        $equipments = $this->FuelLevels->Equipments->find('list', limit: 200)->all();
        $this->set(compact('fuelLevel', 'equipments'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Fuel Level id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $fuelLevel = $this->FuelLevels->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fuelLevel = $this->FuelLevels->patchEntity($fuelLevel, $this->request->getData());

            $fuelLevel->modifiedby = $session->read('Auth.Username');

            if ($this->FuelLevels->save($fuelLevel)) {
                $this->Flash->success(__('The fuel level has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fuel level could not be saved. Please, try again.'));
        }
        $equipments = $this->FuelLevels->Equipments->find('list', limit: 200)->all();
        $this->set(compact('fuelLevel', 'equipments'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Fuel Level id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $fuelLevel = $this->FuelLevels->get($id);

        $fuelLevel->modifiedby = $session->read('Auth.Username');
        $fuelLevel->deleted = 1;

        if ($this->FuelLevels->save($fuelLevel)) {
            $this->Flash->success(__('The fuel level has been deleted.'));
        } else {
            $this->Flash->error(__('The fuel level could not be deleted. Please, try again.'));
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
        $fuelLevel = $this->FuelLevels->newEmptyEntity();
        if ($this->request->is('post')) {
            $fuelLevel = $this->FuelLevels->patchEntity($fuelLevel, $this->request->getData());

            $fuelLevel->createdby = $session->read('Auth.Username');
            $fuelLevel->modifiedby = $session->read('Auth.Username');
            $fuelLevel->deleted = 0;

            try{
                if ($this->FuelLevels->save($fuelLevel)) {
                    $response = [
                        'message' => 'Data saved successfully!',
                        'data' => $fuelLevel->toArray()
                    ];
                }else {
                    $errors = $fuelLevel->getErrors();
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
