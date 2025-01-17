<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Resources Controller
 *
 * @property \App\Model\Table\ResourcesTable $Resources
 */
class ResourcesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Resources->find()->where(['Resources.deleted' => 0]);
        $resources = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $this->set(compact('resources'));
    }

    /**
     * View method
     *
     * @param string|null $id Resource id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $resource = $this->Resources->get($id, contain: ['Accessrights']);
        $this->set(compact('resource'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $resource = $this->Resources->newEmptyEntity();
        if ($this->request->is('post')) {
            $resource = $this->Resources->patchEntity($resource, $this->request->getData());

            $resource->createdby = $session->read('Auth.Username');
            $resource->modifiedby = $session->read('Auth.Username');
            $resource->deleted = 0;

            if ($this->Resources->save($resource)) {
                $this->Flash->success(__('The resource has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The resource could not be saved. Please, try again.'));
        }
        $this->set(compact('resource'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Resource id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $resource = $this->Resources->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $resource = $this->Resources->patchEntity($resource, $this->request->getData());

            $resource->modifiedby = $session->read('Auth.Username');

            if ($this->Resources->save($resource)) {
                $this->Flash->success(__('The resource has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The resource could not be saved. Please, try again.'));
        }
        $this->set(compact('resource'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Resource id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $resource = $this->Resources->get($id);

        $resource->modifiedby = $session->read('Auth.Username');
        $resource->deleted = 0;

        if ($this->Resources->save($resource)) {
            $this->Flash->success(__('The resource has been deleted.'));
        } else {
            $this->Flash->error(__('The resource could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
