<?php
declare(strict_types=1);

namespace App\Controller;

use Exception;

/**
 * Purchasegroups Controller
 *
 * @property \App\Model\Table\PurchasegroupsTable $Purchasegroups
 */
class PurchasegroupsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('PurchasesMetrics');
    }

    public function dashboard()
    {
        $timeRange = $this->request->getQuery('range', 'last_12_months');

        $metrics = [
            'supplier_performance' => $this->PurchasesMetrics->getSupplierPerformance(),
            'procurement_trends' => $this->PurchasesMetrics->getMonthlyProcurementTrends(),
            'category_spend' => $this->PurchasesMetrics->getCategoryWiseSpend(),
            'price_variance' => $this->PurchasesMetrics->getPriceVarianceAnalysis(),
            'delivery_performance' => $this->PurchasesMetrics->getDeliveryPerformance(),
            'top_products' => $this->PurchasesMetrics->getTopProcuredProducts(5, 'last_quarter'),
            'yoy_growth' => $this->PurchasesMetrics->getYearOverYearGrowth(),
        ];
        $supplierPerformance = $this->PurchasesMetrics->getSupplierPerformance();
        $this->set(compact('metrics', 'supplierPerformance'));
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Purchasegroups->find()->where(['Purchasegroups.deleted' => 0]);
        $purchasegroups = $this->paginate($query, ['limit' => 10000, 'maxLimit' => 10000]);

        $this->dashboard();

        $this->set(compact('purchasegroups'));
    }

    /**
     * View method
     *
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($reference = null)
    {
        $this->request->getSession()->delete('PGReference');
        $purchasegroup = $this->Purchasegroups->find()
            ->where(['reference' => $reference])
            ->firstOrFail();

        $POData = GeneralController::getPOData($reference);

        $this->set(compact('purchasegroup', 'POData'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $purchasegroup = $this->Purchasegroups->newEmptyEntity();
        if ($this->request->is('post')) {
            $purchasegroup = $this->Purchasegroups->patchEntity($purchasegroup, $this->request->getData());

            $purchasegroup->createdby = $session->read('Auth.Username');
            $purchasegroup->modifiedby = $session->read('Auth.Username');
            $purchasegroup->deleted = 0;

            if ($this->Purchasegroups->save($purchasegroup)) {
                $this->Flash->success(__('The purchasegroup has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchasegroup could not be saved. Please, try again.'));
        }
        $this->set(compact('purchasegroup'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Purchasegroup id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $purchasegroup = $this->Purchasegroups->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $purchasegroup = $this->Purchasegroups->patchEntity($purchasegroup, $this->request->getData());

            $purchasegroup->modifiedby = $session->read('Auth.Username');

            if ($this->Purchasegroups->save($purchasegroup)) {
                $this->Flash->success(__('The purchasegroup has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchasegroup could not be saved. Please, try again.'));
        }
        $this->set(compact('purchasegroup'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Purchasegroup id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $this->request->allowMethod(['post', 'delete']);
        $purchasegroup = $this->Purchasegroups->get($id);

        $purchasegroup->modifiedby = $session->read('Auth.Username');
        $purchasegroup->deleted = 1;

        if ($this->Purchasegroups->save($purchasegroup)) {
            $this->Flash->success(__('The purchasegroup has been deleted.'));
        } else {
            $this->Flash->error(__('The purchasegroup could not be deleted. Please, try again.'));
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
        $purchasegroup = $this->Purchasegroups->newEmptyEntity();
        if ($this->request->is('post')) {
            $purchasegroup = $this->Purchasegroups->patchEntity($purchasegroup, $this->request->getData());

            $purchasegroup->createdby = $session->read('Auth.Username');
            $purchasegroup->modifiedby = $session->read('Auth.Username');
            $purchasegroup->deleted = 0;

            try{
                if ($this->Purchasegroups->save($purchasegroup)) {
                    $response = [
                        'message' => 'Data saved successfully!',
                        'data' => $purchasegroup->toArray()
                    ];
                }else {
                    $errors = $purchasegroup->getErrors();
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
