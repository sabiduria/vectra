<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Transfersdetail> $transfersdetails
 */
?>
<div class="mt-3">
    <?= $this->Html->link(__('New Transfersdetail'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']) ?>
    <h3><?= __('Transfersdetails') ?></h3>
    <div class="table-responsive">
        <table class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" id="datatable-buttons">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('transfer_id') ?></th>
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
                <?php foreach ($transfersdetails as $transfersdetail): ?>
                <tr>
                    <td><?= $this->Number->format($transfersdetail->id) ?></td>
                    <td><?= $transfersdetail->hasValue('transfer') ? $this->Html->link($transfersdetail->transfer->id, ['controller' => 'Transfers', 'action' => 'view', $transfersdetail->transfer->id]) : '' ?></td>
                    <td><?= $transfersdetail->hasValue('product') ? $this->Html->link($transfersdetail->product->name, ['controller' => 'Products', 'action' => 'view', $transfersdetail->product->id]) : '' ?></td>
                    <td><?= $transfersdetail->qty === null ? '' : $this->Number->format($transfersdetail->qty) ?></td>
                    <td><?= h($transfersdetail->created) ?></td>
                    <td><?= h($transfersdetail->modified) ?></td>
                    <td><?= h($transfersdetail->createdby) ?></td>
                    <td><?= h($transfersdetail->modifiedby) ?></td>
                    <td><?= h($transfersdetail->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $transfersdetail->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $transfersdetail->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $transfersdetail->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>