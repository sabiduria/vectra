<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Purchase> $purchases
 */
?>
<div class="mt-3">
    <?= $this->Html->link(__('New Purchase'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']) ?>
    <h3><?= __('Purchases') ?></h3>
    <div class="table-responsive">
        <table class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" id="datatable-buttons">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('status_id') ?></th>
                    <th><?= $this->Paginator->sort('supplier_id') ?></th>
                    <th><?= $this->Paginator->sort('reference') ?></th>
                    <th><?= $this->Paginator->sort('qty') ?></th>
                    <th><?= $this->Paginator->sort('receipt_date') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($purchases as $purchase): ?>
                <tr>
                    <td><?= $this->Number->format($purchase->id) ?></td>
                    <td><?= $purchase->hasValue('status') ? $this->Html->link($purchase->status->name, ['controller' => 'Statuses', 'action' => 'view', $purchase->status->id]) : '' ?></td>
                    <td><?= $purchase->hasValue('supplier') ? $this->Html->link($purchase->supplier->name, ['controller' => 'Suppliers', 'action' => 'view', $purchase->supplier->id]) : '' ?></td>
                    <td><?= h($purchase->reference) ?></td>
                    <td><?= $purchase->qty === null ? '' : $this->Number->format($purchase->qty) ?></td>
                    <td><?= h($purchase->receipt_date) ?></td>
                    <td><?= h($purchase->created) ?></td>
                    <td><?= h($purchase->modified) ?></td>
                    <td><?= h($purchase->createdby) ?></td>
                    <td><?= h($purchase->modifiedby) ?></td>
                    <td><?= h($purchase->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $purchase->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $purchase->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $purchase->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>