<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\ConnectionManager;
use Exception;

/**
 * Affectations Controller
 *
 * @property \App\Model\Table\AffectationsTable $Affectations
 */
class AffectationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Affectations->find()->where(['Affectations.deleted' => 0])
            ->contain(['Users', 'Profiles', 'Shops']);
        $affectations = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $this->set(compact('affectations'));
    }

    /**
     * View method
     *
     * @param string|null $id Affectation id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $affectation = $this->Affectations->get($id, contain: ['Users', 'Profiles', 'Shops', 'Attendances']);
        $this->set(compact('affectation'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $affectation = $this->Affectations->newEmptyEntity();
        if ($this->request->is('post')) {
            $affectation = $this->Affectations->patchEntity($affectation, $this->request->getData());

            $affectation->createdby = $session->read('Auth.Username');
            $affectation->modifiedby = $session->read('Auth.Username');
            $affectation->deleted = 0;

            if ($this->Affectations->save($affectation)) {
                $this->Flash->success(__('The affectation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The affectation could not be saved. Please, try again.'));
        }
        $users = $this->Affectations->Users->find('list', limit: 200)->all();
        $profiles = $this->Affectations->Profiles->find('list', limit: 200)->all();
        $shops = $this->Affectations->Shops->find('list', limit: 200)->all();
        $this->set(compact('affectation', 'users', 'profiles', 'shops'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Affectation id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $affectation = $this->Affectations->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $affectation = $this->Affectations->patchEntity($affectation, $this->request->getData());

            $affectation->modifiedby = $session->read('Auth.Username');

            if ($this->Affectations->save($affectation)) {
                $this->Flash->success(__('The affectation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The affectation could not be saved. Please, try again.'));
        }
        $users = $this->Affectations->Users->find('list', limit: 200)->all();
        $profiles = $this->Affectations->Profiles->find('list', limit: 200)->all();
        $shops = $this->Affectations->Shops->find('list', limit: 200)->all();
        $this->set(compact('affectation', 'users', 'profiles', 'shops'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Affectation id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $affectation = $this->Affectations->get($id);

        $affectation->modifiedby = $session->read('Auth.Username');
        $affectation->deleted = 1;

        if ($this->Affectations->save($affectation)) {
            $this->Flash->success(__('The affectation has been deleted.'));
        } else {
            $this->Flash->error(__('The affectation could not be deleted. Please, try again.'));
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
        $affectation = $this->Affectations->newEmptyEntity();
        if ($this->request->is('post')) {
            $affectation = $this->Affectations->patchEntity($affectation, $this->request->getData());

            $affectation->createdby = $session->read('Auth.Username');
            $affectation->modifiedby = $session->read('Auth.Username');
            $affectation->deleted = 0;

            try{
                if ($this->Affectations->save($affectation)) {
                    $response = [
                        'message' => 'Data saved successfully!',
                        'data' => $affectation->toArray()
                    ];
                }else {
                    $errors = $affectation->getErrors();
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

    public function chooser($shop_id = null)
    {
        $session = $this->request->getSession();
        $this->viewBuilder()->setLayout('empty2');
        if ($shop_id != null){
            $details = self::getLoginDetails($session->read('Auth.Id'), $shop_id);
            foreach ($details as $detail){
                $session->write('Auth.ShopId', $detail['shop_id']);
                $session->write('Auth.ShopName', $detail['shop_name']);
                $session->write('Auth.Profile', $detail['profile_name']);
            }

            return $this->redirect(['controller' => 'general', 'action' => 'dashboard']);
        }
    }

    public static function getLoginDetails($user_id, $shop_id = null): mixed
    {
        $conn = ConnectionManager::get('default');
        if ($shop_id == null){
            $stmt = $conn->execute('SELECT a.id, p.name profile_name, p.id profile_id, s.name shop_name, s.id shop_id, s.address, s.phone FROM affectations a INNER JOIN users u ON u.id = a.user_id INNER JOIN profiles p ON p.id = a.profile_id INNER JOIN shops s ON s.id = a.shop_id WHERE user_id = :user_id', ['user_id' => $user_id]);
        } else {
            $stmt = $conn->execute('SELECT a.id, p.name profile_name, p.id profile_id, s.name shop_name, s.id shop_id, s.address, s.phone FROM affectations a INNER JOIN users u ON u.id = a.user_id INNER JOIN profiles p ON p.id = a.profile_id INNER JOIN shops s ON s.id = a.shop_id WHERE user_id = :user_id AND shop_id = :shop_id', ['user_id' => $user_id, 'shop_id' => $shop_id]);
        }
        return $stmt->fetchAll('assoc');
    }
}
