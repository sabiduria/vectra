<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Stockinsdetail> $stockinsdetails
 */
?>
<div class="mt-3">
    <?= $this->Html->link(__('New Stockinsdetail'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']) ?>
    <h3><?= __('Stockinsdetails') ?></h3>
    <div class="table-responsive">
        <table class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" id="datatable-buttons">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('product_id') ?></th>
                    <th><?= $this->Paginator->sort('stockin_id') ?></th>
                    <th><?= $this->Paginator->sort('purchase_price') ?></th>
                    <th><?= $this->Paginator->sort('barcode') ?></th>
                    <th><?= $this->Paginator->sort('qty') ?></th>
                    <th><?= $this->Paginator->sort('expiry_date') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($stockinsdetails as $stockinsdetail): ?>
                <tr>
                    <td><?= $this->Number->format($stockinsdetail->id) ?></td>
                    <td><?= $stockinsdetail->hasValue('product') ? $this->Html->link($stockinsdetail->product->name, ['controller' => 'Products', 'action' => 'view', $stockinsdetail->product->id]) : '' ?></td>
                    <td><?= $stockinsdetail->hasValue('stockin') ? $this->Html->link($stockinsdetail->stockin->id, ['controller' => 'Stockins', 'action' => 'view', $stockinsdetail->stockin->id]) : '' ?></td>
                    <td><?= $stockinsdetail->purchase_price === null ? '' : $this->Number->format($stockinsdetail->purchase_price) ?></td>
                    <td><?= h($stockinsdetail->barcode) ?></td>
                    <td><?= $stockinsdetail->qty === null ? '' : $this->Number->format($stockinsdetail->qty) ?></td>
                    <td><?= h($stockinsdetail->expiry_date) ?></td>
                    <td><?= h($stockinsdetail->created) ?></td>
                    <td><?= h($stockinsdetail->modified) ?></td>
                    <td><?= h($stockinsdetail->createdby) ?></td>
                    <td><?= h($stockinsdetail->modifiedby) ?></td>
                    <td><?= h($stockinsdetail->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $stockinsdetail->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $stockinsdetail->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $stockinsdetail->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>