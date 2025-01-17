<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sale $sale
 */
 $this->set('title_2', 'Sales');
?>
<div class="row">
    <div class="column column-80">
        <div class="sales view content">
            <h3><?= h($sale->id) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $sale->hasValue('user') ? $this->Html->link($sale->user->id, ['controller' => 'Users', 'action' => 'view', $sale->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Customer') ?></th>
                    <td><?= $sale->hasValue('customer') ? $this->Html->link($sale->customer->name, ['controller' => 'Customers', 'action' => 'view', $sale->customer->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Reference') ?></th>
                    <td><?= h($sale->reference) ?></td>
                </tr>
                <tr>
                    <th><?= __('Payment Method') ?></th>
                    <td><?= h($sale->payment_method) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $sale->hasValue('status') ? $this->Html->link($sale->status->name, ['controller' => 'Statuses', 'action' => 'view', $sale->status->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($sale->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($sale->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($sale->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Total Amount') ?></th>
                    <td><?= $sale->total_amount === null ? '' : $this->Number->format($sale->total_amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($sale->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($sale->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $sale->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Salesitems') ?></h4>
                <?php if (!empty($sale->salesitems)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Product Id') ?></th>
                            <th><?= __('Sale Id') ?></th>
                            <th><?= __('Qty') ?></th>
                            <th><?= __('Packaging Id') ?></th>
                            <th><?= __('Unit Price') ?></th>
                            <th><?= __('Subtotal') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($sale->salesitems as $salesitem) : ?>
                        <tr>
                            <td><?= h($salesitem->id) ?></td>
                            <td><?= h($salesitem->product_id) ?></td>
                            <td><?= h($salesitem->sale_id) ?></td>
                            <td><?= h($salesitem->qty) ?></td>
                            <td><?= h($salesitem->packaging_id) ?></td>
                            <td><?= h($salesitem->unit_price) ?></td>
                            <td><?= h($salesitem->subtotal) ?></td>
                            <td><?= h($salesitem->created) ?></td>
                            <td><?= h($salesitem->modified) ?></td>
                            <td><?= h($salesitem->createdby) ?></td>
                            <td><?= h($salesitem->modifiedby) ?></td>
                            <td><?= h($salesitem->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Salesitems', 'action' => 'view', $salesitem->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Salesitems', 'action' => 'edit', $salesitem->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Salesitems', 'action' => 'delete', $salesitem->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
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