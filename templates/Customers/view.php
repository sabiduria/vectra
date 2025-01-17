<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer $customer
 */
 $this->set('title_2', 'Customers');
?>
<div class="row">
    <div class="column column-80">
        <div class="customers view content">
            <h3><?= h($customer->name) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($customer->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Phone') ?></th>
                    <td><?= h($customer->phone) ?></td>
                </tr>
                <tr>
                    <th><?= __('Marketer Name') ?></th>
                    <td><?= h($customer->marketer_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Username') ?></th>
                    <td><?= h($customer->username) ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($customer->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($customer->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($customer->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Marketer Id') ?></th>
                    <td><?= $customer->marketer_id === null ? '' : $this->Number->format($customer->marketer_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($customer->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($customer->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $customer->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Loyaltypoints') ?></h4>
                <?php if (!empty($customer->loyaltypoints)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Customer Id') ?></th>
                            <th><?= __('Issuedpoints') ?></th>
                            <th><?= __('Redeemedpoints') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($customer->loyaltypoints as $loyaltypoint) : ?>
                        <tr>
                            <td><?= h($loyaltypoint->id) ?></td>
                            <td><?= h($loyaltypoint->customer_id) ?></td>
                            <td><?= h($loyaltypoint->issuedpoints) ?></td>
                            <td><?= h($loyaltypoint->redeemedpoints) ?></td>
                            <td><?= h($loyaltypoint->created) ?></td>
                            <td><?= h($loyaltypoint->modified) ?></td>
                            <td><?= h($loyaltypoint->createdby) ?></td>
                            <td><?= h($loyaltypoint->modifiedby) ?></td>
                            <td><?= h($loyaltypoint->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Loyaltypoints', 'action' => 'view', $loyaltypoint->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Loyaltypoints', 'action' => 'edit', $loyaltypoint->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Loyaltypoints', 'action' => 'delete', $loyaltypoint->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Orders') ?></h4>
                <?php if (!empty($customer->orders)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Customer Id') ?></th>
                            <th><?= __('Status Id') ?></th>
                            <th><?= __('Reference') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($customer->orders as $order) : ?>
                        <tr>
                            <td><?= h($order->id) ?></td>
                            <td><?= h($order->customer_id) ?></td>
                            <td><?= h($order->status_id) ?></td>
                            <td><?= h($order->reference) ?></td>
                            <td><?= h($order->created) ?></td>
                            <td><?= h($order->modified) ?></td>
                            <td><?= h($order->createdby) ?></td>
                            <td><?= h($order->modifiedby) ?></td>
                            <td><?= h($order->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Orders', 'action' => 'view', $order->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Orders', 'action' => 'edit', $order->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Orders', 'action' => 'delete', $order->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Sales') ?></h4>
                <?php if (!empty($customer->sales)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Customer Id') ?></th>
                            <th><?= __('Reference') ?></th>
                            <th><?= __('Total Amount') ?></th>
                            <th><?= __('Payment Method') ?></th>
                            <th><?= __('Status Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($customer->sales as $sale) : ?>
                        <tr>
                            <td><?= h($sale->id) ?></td>
                            <td><?= h($sale->user_id) ?></td>
                            <td><?= h($sale->customer_id) ?></td>
                            <td><?= h($sale->reference) ?></td>
                            <td><?= h($sale->total_amount) ?></td>
                            <td><?= h($sale->payment_method) ?></td>
                            <td><?= h($sale->status_id) ?></td>
                            <td><?= h($sale->created) ?></td>
                            <td><?= h($sale->modified) ?></td>
                            <td><?= h($sale->createdby) ?></td>
                            <td><?= h($sale->modifiedby) ?></td>
                            <td><?= h($sale->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Sales', 'action' => 'view', $sale->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Sales', 'action' => 'edit', $sale->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Sales', 'action' => 'delete', $sale->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
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