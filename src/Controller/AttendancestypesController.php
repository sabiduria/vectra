<?php
declare(strict_types=1);

namespace App\Controller;

use Exception;

/**
 * Attendancestypes Controller
 *
 * @property \App\Model\Table\AttendancestypesTable $Attendancestypes
 */
class AttendancestypesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Attendancestypes->find()->where(['Attendancestypes.deleted' => 0]);
        $attendancestypes = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $this->set(compact('attendancestypes'));
    }

    /**
     * View method
     *
     * @param string|null $id Attendancestype id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $attendancestype = $this->Attendancestypes->get($id, contain: ['Attendances']);
        $this->set(compact('attendancestype'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $attendancestype = $this->Attendancestypes->newEmptyEntity();
        if ($this->request->is('post')) {
            $attendancestype = $this->Attendancestypes->patchEntity($attendancestype, $this->request->getData());

            $attendancestype->createdby = $session->read('Auth.Username');
            $attendancestype->modifiedby = $session->read('Auth.Username');
            $attendancestype->deleted = 0;

            if ($this->Attendancestypes->save($attendancestype)) {
                $this->Flash->success(__('The attendancestype has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The attendancestype could not be saved. Please, try again.'));
        }
        $this->set(compact('attendancestype'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Attendancestype id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $attendancestype = $this->Attendancestypes->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $attendancestype = $this->Attendancestypes->patchEntity($attendancestype, $this->request->getData());

            $attendancestype->modifiedby = $session->read('Auth.Username');

            if ($this->Attendancestypes->save($attendancestype)) {
                $this->Flash->success(__('The attendancestype has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The attendancestype could not be saved. Please, try again.'));
        }
        $this->set(compact('attendancestype'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Attendancestype id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $attendancestype = $this->Attendancestypes->get($id);

        $attendancestype->modifiedby = $session->read('Auth.Username');
        $attendancestype->deleted = 1;

        if ($this->Attendancestypes->save($attendancestype)) {
            $this->Flash->success(__('The attendancestype has been deleted.'));
        } else {
            $this->Flash->error(__('The attendancestype could not be deleted. Please, try again.'));
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
        $attendancestype = $this->Attendancestypes->newEmptyEntity();
        if ($this->request->is('post')) {
            $attendancestype = $this->Attendancestypes->patchEntity($attendancestype, $this->request->getData());

            $attendancestype->createdby = $session->read('Auth.Username');
            $attendancestype->modifiedby = $session->read('Auth.Username');
            $attendancestype->deleted = 0;

            try{
                if ($this->Attendancestypes->save($attendancestype)) {
                    $response = [
                        'message' => 'Data saved successfully!',
                        'data' => $attendancestype->toArray()
                    ];
                }else {
                    $errors = $attendancestype->getErrors();
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
