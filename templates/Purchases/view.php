<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Purchase $purchase
 */
?>
<div class="row">
    <div class="column column-80">
        <div class="purchases view content">
            <h3><?= h($purchase->id) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $purchase->hasValue('status') ? $this->Html->link($purchase->status->name, ['controller' => 'Statuses', 'action' => 'view', $purchase->status->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Supplier') ?></th>
                    <td><?= $purchase->hasValue('supplier') ? $this->Html->link($purchase->supplier->name, ['controller' => 'Suppliers', 'action' => 'view', $purchase->supplier->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Reference') ?></th>
                    <td><?= h($purchase->reference) ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($purchase->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($purchase->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($purchase->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Qty') ?></th>
                    <td><?= $purchase->qty === null ? '' : $this->Number->format($purchase->qty) ?></td>
                </tr>
                <tr>
                    <th><?= __('Receipt Date') ?></th>
                    <td><?= h($purchase->receipt_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($purchase->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($purchase->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $purchase->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Paymentstosuppliers') ?></h4>
                <?php if (!empty($purchase->paymentstosuppliers)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Purchase Id') ?></th>
                            <th><?= __('Amount') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($purchase->paymentstosuppliers as $paymentstosupplier) : ?>
                        <tr>
                            <td><?= h($paymentstosupplier->id) ?></td>
                            <td><?= h($paymentstosupplier->purchase_id) ?></td>
                            <td><?= h($paymentstosupplier->amount) ?></td>
                            <td><?= h($paymentstosupplier->created) ?></td>
                            <td><?= h($paymentstosupplier->modified) ?></td>
                            <td><?= h($paymentstosupplier->createdby) ?></td>
                            <td><?= h($paymentstosupplier->modifiedby) ?></td>
                            <td><?= h($paymentstosupplier->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Paymentstosuppliers', 'action' => 'view', $paymentstosupplier->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Paymentstosuppliers', 'action' => 'edit', $paymentstosupplier->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Paymentstosuppliers', 'action' => 'delete', $paymentstosupplier->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Purchasesitems') ?></h4>
                <?php if (!empty($purchase->purchasesitems)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Purchase Id') ?></th>
                            <th><?= __('Product Id') ?></th>
                            <th><?= __('Qty') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($purchase->purchasesitems as $purchasesitem) : ?>
                        <tr>
                            <td><?= h($purchasesitem->id) ?></td>
                            <td><?= h($purchasesitem->purchase_id) ?></td>
                            <td><?= h($purchasesitem->product_id) ?></td>
                            <td><?= h($purchasesitem->qty) ?></td>
                            <td><?= h($purchasesitem->created) ?></td>
                            <td><?= h($purchasesitem->modified) ?></td>
                            <td><?= h($purchasesitem->createdby) ?></td>
                            <td><?= h($purchasesitem->modifiedby) ?></td>
                            <td><?= h($purchasesitem->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Purchasesitems', 'action' => 'view', $purchasesitem->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Purchasesitems', 'action' => 'edit', $purchasesitem->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Purchasesitems', 'action' => 'delete', $purchasesitem->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
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