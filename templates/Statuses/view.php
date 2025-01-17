<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Status $status
 */
 $this->set('title_2', 'Statuses');
?>
<div class="row">
    <div class="column column-80">
        <div class="statuses view content">
            <h3><?= h($status->name) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($status->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tables') ?></th>
                    <td><?= h($status->tables) ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($status->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($status->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($status->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($status->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($status->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $status->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Leaves') ?></h4>
                <?php if (!empty($status->leaves)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Leavestype Id') ?></th>
                            <th><?= __('Status Id') ?></th>
                            <th><?= __('Startdate') ?></th>
                            <th><?= __('Enddate') ?></th>
                            <th><?= __('Reason') ?></th>
                            <th><?= __('Approvedby') ?></th>
                            <th><?= __('Approveddate') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($status->leaves as $leave) : ?>
                        <tr>
                            <td><?= h($leave->id) ?></td>
                            <td><?= h($leave->user_id) ?></td>
                            <td><?= h($leave->leavestype_id) ?></td>
                            <td><?= h($leave->status_id) ?></td>
                            <td><?= h($leave->startdate) ?></td>
                            <td><?= h($leave->enddate) ?></td>
                            <td><?= h($leave->reason) ?></td>
                            <td><?= h($leave->approvedby) ?></td>
                            <td><?= h($leave->approveddate) ?></td>
                            <td><?= h($leave->created) ?></td>
                            <td><?= h($leave->modified) ?></td>
                            <td><?= h($leave->createdby) ?></td>
                            <td><?= h($leave->modifiedby) ?></td>
                            <td><?= h($leave->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Leaves', 'action' => 'view', $leave->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Leaves', 'action' => 'edit', $leave->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Leaves', 'action' => 'delete', $leave->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Orders') ?></h4>
                <?php if (!empty($status->orders)) : ?>
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
                        <?php foreach ($status->orders as $order) : ?>
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
                <h4><?= __('Related Purchases') ?></h4>
                <?php if (!empty($status->purchases)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Status Id') ?></th>
                            <th><?= __('Supplier Id') ?></th>
                            <th><?= __('Reference') ?></th>
                            <th><?= __('Qty') ?></th>
                            <th><?= __('Receipt Date') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($status->purchases as $purchase) : ?>
                        <tr>
                            <td><?= h($purchase->id) ?></td>
                            <td><?= h($purchase->status_id) ?></td>
                            <td><?= h($purchase->supplier_id) ?></td>
                            <td><?= h($purchase->reference) ?></td>
                            <td><?= h($purchase->qty) ?></td>
                            <td><?= h($purchase->receipt_date) ?></td>
                            <td><?= h($purchase->created) ?></td>
                            <td><?= h($purchase->modified) ?></td>
                            <td><?= h($purchase->createdby) ?></td>
                            <td><?= h($purchase->modifiedby) ?></td>
                            <td><?= h($purchase->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Purchases', 'action' => 'view', $purchase->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Purchases', 'action' => 'edit', $purchase->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Purchases', 'action' => 'delete', $purchase->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Sales') ?></h4>
                <?php if (!empty($status->sales)) : ?>
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
                        <?php foreach ($status->sales as $sale) : ?>
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