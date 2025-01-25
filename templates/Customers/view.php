<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer $customer
 */
 $this->set('title_2', 'Clients');
?>
<div class="row">
    <div class="column column-80">
        <div class="customers view content">
            <div class="row">
                <div class="col-sm-9">
                    <h3><?= h($customer->name) ?></h3>
                    <p>Telephone : <?= h($customer->phone) ?></p>
                </div>
                <div class="col-sm-3">
                    <div class="text-center">
                        <h3>Points de Loyautés</h3>
                        <h1>50</h1>
                    </div>
                </div>
            </div>
            <hr>
            <div class="related">
                <h5><?= __('Points de Loyautés') ?></h5>
                <?php if (!empty($customer->loyaltypoints)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Points Gagnés') ?></th>
                            <th><?= __('Points Utilisés') ?></th>
                            <th><?= __('Date') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($customer->loyaltypoints as $loyaltypoint) : ?>
                        <tr>
                            <td><?= h($loyaltypoint->id) ?></td>
                            <td><?= h($loyaltypoint->issuedpoints) ?></td>
                            <td><?= h($loyaltypoint->redeemedpoints) ?></td>
                            <td><?= h($loyaltypoint->created) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('Details'), ['controller' => 'Loyaltypoints', 'action' => 'view', $loyaltypoint->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Editer'), ['controller' => 'Loyaltypoints', 'action' => 'edit', $loyaltypoint->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Loyaltypoints', 'action' => 'delete', $loyaltypoint->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="related">
                        <h5><?= __('Factures') ?></h5>
                        <?php if (!empty($customer->sales)) : ?>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th><?= __('Id') ?></th>
                                        <th><?= __('Reference') ?></th>
                                        <th><?= __('Total') ?></th>
                                        <th><?= __('Methode de Paiement') ?></th>
                                        <th><?= __('Status') ?></th>
                                        <th><?= __('Date') ?></th>
                                        <th><?= __('Caissier') ?></th>
                                        <th class="actions"><?= __('Actions') ?></th>
                                    </tr>
                                    <?php foreach ($customer->sales as $sale) : ?>
                                        <tr>
                                            <td><?= h($sale->id) ?></td>
                                            <td><?= h($sale->reference) ?></td>
                                            <td><?= h($sale->total_amount) ?></td>
                                            <td><?= h($sale->payment_method) ?></td>
                                            <td><?= h($sale->status_id) ?></td>
                                            <td><?= h($sale->created) ?></td>
                                            <td><?= h($sale->createdby) ?></td>
                                            <td class="actions">
                                                <?= $this->Html->link(__('Details'), ['controller' => 'Sales', 'action' => 'view', $sale->id], ['class' => 'btn btn-success btn-sm']) ?>
                                                <?= $this->Html->link(__('Editer'), ['controller' => 'Sales', 'action' => 'edit', $sale->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                                <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Sales', 'action' => 'delete', $sale->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="related">
                        <h5><?= __('Commandes') ?></h5>
                        <?php if (!empty($customer->orders)) : ?>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th><?= __('Id') ?></th>
                                        <th><?= __('Status') ?></th>
                                        <th><?= __('Reference') ?></th>
                                        <th><?= __('Date') ?></th>
                                        <th class="actions"><?= __('Actions') ?></th>
                                    </tr>
                                    <?php foreach ($customer->orders as $order) : ?>
                                        <tr>
                                            <td><?= h($order->id) ?></td>
                                            <td><?= h($order->status_id) ?></td>
                                            <td><?= h($order->reference) ?></td>
                                            <td><?= h($order->created) ?></td>
                                            <td class="actions">
                                                <?= $this->Html->link(__('Details'), ['controller' => 'Orders', 'action' => 'view', $order->id], ['class' => 'btn btn-success btn-sm']) ?>
                                                <?= $this->Html->link(__('Editer'), ['controller' => 'Orders', 'action' => 'edit', $order->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                                <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Orders', 'action' => 'delete', $order->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
