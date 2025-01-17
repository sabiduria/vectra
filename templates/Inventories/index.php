<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Inventory> $inventories
 */
?>
<div class="mt-3">
    <?= $this->Html->link(__('New Inventory'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']) ?>
    <h3><?= __('Inventories') ?></h3>
    <div class="table-responsive">
        <table class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" id="datatable-buttons">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('product_id') ?></th>
                    <th><?= $this->Paginator->sort('qty') ?></th>
                    <th><?= $this->Paginator->sort('inventory_period') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($inventories as $inventory): ?>
                <tr>
                    <td><?= $this->Number->format($inventory->id) ?></td>
                    <td><?= $inventory->hasValue('product') ? $this->Html->link($inventory->product->name, ['controller' => 'Products', 'action' => 'view', $inventory->product->id]) : '' ?></td>
                    <td><?= $inventory->qty === null ? '' : $this->Number->format($inventory->qty) ?></td>
                    <td><?= h($inventory->inventory_period) ?></td>
                    <td><?= h($inventory->created) ?></td>
                    <td><?= h($inventory->modified) ?></td>
                    <td><?= h($inventory->createdby) ?></td>
                    <td><?= h($inventory->modifiedby) ?></td>
                    <td><?= h($inventory->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $inventory->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $inventory->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $inventory->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>