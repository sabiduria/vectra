<?php
declare(strict_types=1);

namespace App\Controller;

use Exception;

/**
 * Rooms Controller
 *
 * @property \App\Model\Table\RoomsTable $Rooms
 */
class RoomsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Rooms->find()->where(['Rooms.deleted' => 0])
            ->contain(['Shops']);
        $rooms = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $shops = $this->Rooms->Shops->find('list', limit: 200)->all();

        $this->set(compact('rooms', 'shops'));
    }

    /**
     * View method
     *
     * @param string|null $id Room id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $room = $this->Rooms->get($id, contain: ['Shops', 'Shopstocks']);
        $this->set(compact('room'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $room = $this->Rooms->newEmptyEntity();
        if ($this->request->is('post')) {
            $room = $this->Rooms->patchEntity($room, $this->request->getData());

            $room->createdby = $session->read('Auth.Username');
            $room->modifiedby = $session->read('Auth.Username');
            $room->deleted = 0;

            if ($this->Rooms->save($room)) {
                $this->Flash->success(__('The room has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The room could not be saved. Please, try again.'));
        }
        $shops = $this->Rooms->Shops->find('list', limit: 200)->all();
        $this->set(compact('room', 'shops'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Room id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $room = $this->Rooms->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $room = $this->Rooms->patchEntity($room, $this->request->getData());

            $room->modifiedby = $session->read('Auth.Username');

            if ($this->Rooms->save($room)) {
                $this->Flash->success(__('The room has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The room could not be saved. Please, try again.'));
        }
        $shops = $this->Rooms->Shops->find('list', limit: 200)->all();
        $this->set(compact('room', 'shops'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Room id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $room = $this->Rooms->get($id);

        $room->modifiedby = $session->read('Auth.Username');
        $room->deleted = 1;

        if ($this->Rooms->save($room)) {
            $this->Flash->success(__('The room has been deleted.'));
        } else {
            $this->Flash->error(__('The room could not be deleted. Please, try again.'));
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
        $room = $this->Rooms->newEmptyEntity();
        if ($this->request->is('post')) {
            $room = $this->Rooms->patchEntity($room, $this->request->getData());

            $room->createdby = $session->read('Auth.Username');
            $room->modifiedby = $session->read('Auth.Username');
            $room->deleted = 0;

            try{
                if ($this->Rooms->save($room)) {
                    $response = [
                        'message' => 'Data saved successfully!',
                        'data' => $room->toArray()
                    ];
                }else {
                    $errors = $room->getErrors();
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
