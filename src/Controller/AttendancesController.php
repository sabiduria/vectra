<?php
declare(strict_types=1);

namespace App\Controller;

use Exception;

/**
 * Attendances Controller
 *
 * @property \App\Model\Table\AttendancesTable $Attendances
 */
class AttendancesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Attendances->find()->where(['Attendances.deleted' => 0])
            ->contain(['Affectations', 'Attendancestypes']);
        $attendances = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $this->set(compact('attendances'));
    }

    /**
     * View method
     *
     * @param string|null $id Attendance id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $attendance = $this->Attendances->get($id, contain: ['Affectations', 'Attendancestypes']);
        $this->set(compact('attendance'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $attendance = $this->Attendances->newEmptyEntity();
        if ($this->request->is('post')) {
            $attendance = $this->Attendances->patchEntity($attendance, $this->request->getData());

            $attendance->createdby = $session->read('Auth.Username');
            $attendance->modifiedby = $session->read('Auth.Username');
            $attendance->deleted = 0;

            if ($this->Attendances->save($attendance)) {
                $this->Flash->success(__('The attendance has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The attendance could not be saved. Please, try again.'));
        }
        $affectations = $this->Attendances->Affectations->find('list', limit: 200)->all();
        $attendancestypes = $this->Attendances->Attendancestypes->find('list', limit: 200)->all();
        $this->set(compact('attendance', 'affectations', 'attendancestypes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Attendance id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $attendance = $this->Attendances->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $attendance = $this->Attendances->patchEntity($attendance, $this->request->getData());

            $attendance->modifiedby = $session->read('Auth.Username');

            if ($this->Attendances->save($attendance)) {
                $this->Flash->success(__('The attendance has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The attendance could not be saved. Please, try again.'));
        }
        $affectations = $this->Attendances->Affectations->find('list', limit: 200)->all();
        $attendancestypes = $this->Attendances->Attendancestypes->find('list', limit: 200)->all();
        $this->set(compact('attendance', 'affectations', 'attendancestypes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Attendance id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $attendance = $this->Attendances->get($id);

        $attendance->modifiedby = $session->read('Auth.Username');
        $attendance->deleted = 1;

        if ($this->Attendances->save($attendance)) {
            $this->Flash->success(__('The attendance has been deleted.'));
        } else {
            $this->Flash->error(__('The attendance could not be deleted. Please, try again.'));
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
        $attendance = $this->Attendances->newEmptyEntity();
        if ($this->request->is('post')) {
            $attendance = $this->Attendances->patchEntity($attendance, $this->request->getData());

            $attendance->createdby = $session->read('Auth.Username');
            $attendance->modifiedby = $session->read('Auth.Username');
            $attendance->deleted = 0;

            try{
                if ($this->Attendances->save($attendance)) {
                    $response = [
                        'message' => 'Data saved successfully!',
                        'data' => $attendance->toArray()
                    ];
                }else {
                    $errors = $attendance->getErrors();
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
