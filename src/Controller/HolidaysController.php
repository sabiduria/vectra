<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Holidays Controller
 *
 * @property \App\Model\Table\HolidaysTable $Holidays
 */
class HolidaysController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Holidays->find()->where(['Holidays.deleted' => 0]);
        $holidays = $this->paginate($query);

        $this->set(compact('holidays'));
    }

    /**
     * View method
     *
     * @param string|null $id Holiday id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $holiday = $this->Holidays->get($id, contain: []);
        $this->set(compact('holiday'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $holiday = $this->Holidays->newEmptyEntity();
        if ($this->request->is('post')) {
            $holiday = $this->Holidays->patchEntity($holiday, $this->request->getData());

            $holiday->createdby = $session->read('Auth.Username');
            $holiday->modifiedby = $session->read('Auth.Username');
            $holiday->deleted = 0;

            if ($this->Holidays->save($holiday)) {
                $this->Flash->success(__('The holiday has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The holiday could not be saved. Please, try again.'));
        }
        $this->set(compact('holiday'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Holiday id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $holiday = $this->Holidays->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $holiday = $this->Holidays->patchEntity($holiday, $this->request->getData());

            $holiday->modifiedby = $session->read('Auth.Username');

            if ($this->Holidays->save($holiday)) {
                $this->Flash->success(__('The holiday has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The holiday could not be saved. Please, try again.'));
        }
        $this->set(compact('holiday'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Holiday id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $holiday = $this->Holidays->get($id);

        $holiday->modifiedby = $session->read('Auth.Username');
        $holiday->deleted = 0;

        if ($this->Holidays->save($holiday)) {
            $this->Flash->success(__('The holiday has been deleted.'));
        } else {
            $this->Flash->error(__('The holiday could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
