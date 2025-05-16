<?php
declare(strict_types=1);

namespace App\Controller;

use Exception;

/**
 * GeneralParams Controller
 *
 * @property \App\Model\Table\GeneralParamsTable $GeneralParams
 */
class GeneralParamsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->GeneralParams->find()->where(['GeneralParams.deleted' => 0]);
        $generalParams = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $this->set(compact('generalParams'));
    }

    /**
     * View method
     *
     * @param string|null $id General Param id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $generalParam = $this->GeneralParams->get($id, contain: []);
        $this->set(compact('generalParam'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $generalParam = $this->GeneralParams->newEmptyEntity();
        if ($this->request->is('post')) {
            $generalParam = $this->GeneralParams->patchEntity($generalParam, $this->request->getData());

            $generalParam->createdby = $session->read('Auth.Username');
            $generalParam->modifiedby = $session->read('Auth.Username');
            $generalParam->deleted = 0;

            if ($this->GeneralParams->save($generalParam)) {
                $this->Flash->success(__('The general param has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The general param could not be saved. Please, try again.'));
        }
        $this->set(compact('generalParam'));
    }

    /**
     * Edit method
     *
     * @param string|null $id General Param id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $generalParam = $this->GeneralParams->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $generalParam = $this->GeneralParams->patchEntity($generalParam, $this->request->getData());

            $generalParam->modifiedby = $session->read('Auth.Username');

            if ($this->GeneralParams->save($generalParam)) {
                $this->Flash->success(__('The general param has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The general param could not be saved. Please, try again.'));
        }
        $this->set(compact('generalParam'));
    }

    /**
     * Delete method
     *
     * @param string|null $id General Param id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $generalParam = $this->GeneralParams->get($id);

        $generalParam->modifiedby = $session->read('Auth.Username');
        $generalParam->deleted = 1;

        if ($this->GeneralParams->save($generalParam)) {
            $this->Flash->success(__('The general param has been deleted.'));
        } else {
            $this->Flash->error(__('The general param could not be deleted. Please, try again.'));
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
        $generalParam = $this->GeneralParams->newEmptyEntity();
        if ($this->request->is('post')) {
            $generalParam = $this->GeneralParams->patchEntity($generalParam, $this->request->getData());

            $generalParam->createdby = $session->read('Auth.Username');
            $generalParam->modifiedby = $session->read('Auth.Username');
            $generalParam->deleted = 0;

            try{
                if ($this->GeneralParams->save($generalParam)) {
                    $response = [
                        'message' => 'Data saved successfully!',
                        'data' => $generalParam->toArray()
                    ];
                }else {
                    $errors = $generalParam->getErrors();
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
