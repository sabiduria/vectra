<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\ConnectionManager;
use Exception;

/**
 * Accessrights Controller
 *
 * @property \App\Model\Table\AccessrightsTable $Accessrights
 */
class AccessrightsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Accessrights->find()->where(['Accessrights.deleted' => 0])
            ->contain(['Profiles', 'Resources']);
        $accessrights = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $this->set(compact('accessrights'));
    }

    /**
     * View method
     *
     * @param string|null $id Accessright id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $accessright = $this->Accessrights->get($id, contain: ['Profiles', 'Resources']);
        $this->set(compact('accessright'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $accessright = $this->Accessrights->newEmptyEntity();
        if ($this->request->is('post')) {
            $accessright = $this->Accessrights->patchEntity($accessright, $this->request->getData());

            $accessright->createdby = $session->read('Auth.Username');
            $accessright->modifiedby = $session->read('Auth.Username');
            $accessright->deleted = 0;

            if ($this->Accessrights->save($accessright)) {
                $this->Flash->success(__('The accessright has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The accessright could not be saved. Please, try again.'));
        }
        $profiles = $this->Accessrights->Profiles->find('list', limit: 200)->all();
        $resources = $this->Accessrights->Resources->find('list', limit: 200)->all();
        $this->set(compact('accessright', 'profiles', 'resources'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Accessright id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $accessright = $this->Accessrights->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $accessright = $this->Accessrights->patchEntity($accessright, $this->request->getData());

            $accessright->modifiedby = $session->read('Auth.Username');

            if ($this->Accessrights->save($accessright)) {
                $this->Flash->success(__('The accessright has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The accessright could not be saved. Please, try again.'));
        }
        $profiles = $this->Accessrights->Profiles->find('list', limit: 200)->all();
        $resources = $this->Accessrights->Resources->find('list', limit: 200)->all();
        $this->set(compact('accessright', 'profiles', 'resources'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Accessright id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $accessright = $this->Accessrights->get($id);

        $accessright->modifiedby = $session->read('Auth.Username');
        $accessright->deleted = 1;

        if ($this->Accessrights->save($accessright)) {
            $this->Flash->success(__('The accessright has been deleted.'));
        } else {
            $this->Flash->error(__('The accessright could not be deleted. Please, try again.'));
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
        $accessright = $this->Accessrights->newEmptyEntity();
        if ($this->request->is('post')) {
            $accessright = $this->Accessrights->patchEntity($accessright, $this->request->getData());

            $accessright->createdby = $session->read('Auth.Username');
            $accessright->modifiedby = $session->read('Auth.Username');
            $accessright->deleted = 0;

            try{
                if ($this->Accessrights->save($accessright)) {
                    $response = [
                        'message' => 'Data saved successfully!',
                        'data' => $accessright->toArray()
                    ];
                }else {
                    $errors = $accessright->getErrors();
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

    public static function checkRightsOn($profile_id, $resource, $access){
        $conn = ConnectionManager::get('default');

        $stmt = $conn->execute('SELECT '.strtolower(substr($access, 0, 1)).' FROM accessrights ar INNER JOIN resources rs ON ar.resource_id = rs.id WHERE ar.profile_id=:profile_id AND rs.generic_name=:resource', ['profile_id'=> $profile_id, 'resource'=> $resource]);
        $result = $stmt->fetch('assoc');
        if ($result!=null){
            foreach ($result as $row) {
                return ($row);
            }
        } else{
            return 0;
        }
        return null;
    }
}
