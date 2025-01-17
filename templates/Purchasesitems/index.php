<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Purchasesitem> $purchasesitems
 */
?>
<div class="mt-3">
    <?= $this->Html->link(__('New Purchasesitem'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']) ?>
    <h3><?= __('Purchasesitems') ?></h3>
    <div class="table-responsive">
        <table class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" id="datatable-buttons">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('purchase_id') ?></th>
                    <th><?= $this->Paginator->sort('product_id') ?></th>
                    <th><?= $this->Paginator->sort('qty') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($purchasesitems as $purchasesitem): ?>
                <tr>
                    <td><?= $this->Number->format($purchasesitem->id) ?></td>
                    <td><?= $purchasesitem->hasValue('purchase') ? $this->Html->link($purchasesitem->purchase->id, ['controller' => 'Purchases', 'action' => 'view', $purchasesitem->purchase->id]) : '' ?></td>
                    <td><?= $purchasesitem->hasValue('product') ? $this->Html->link($purchasesitem->product->name, ['controller' => 'Products', 'action' => 'view', $purchasesitem->product->id]) : '' ?></td>
                    <td><?= $purchasesitem->qty === null ? '' : $this->Number->format($purchasesitem->qty) ?></td>
                    <td><?= h($purchasesitem->created) ?></td>
                    <td><?= h($purchasesitem->modified) ?></td>
                    <td><?= h($purchasesitem->createdby) ?></td>
                    <td><?= h($purchasesitem->modifiedby) ?></td>
                    <td><?= h($purchasesitem->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $purchasesitem->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $purchasesitem->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $purchasesitem->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>