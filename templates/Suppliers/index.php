<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Supplier> $suppliers
 */
?>
<div class="mt-3">
    <?= $this->Html->link(__('New Supplier'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']) ?>
    <h3><?= __('Suppliers') ?></h3>
    <div class="table-responsive">
        <table class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" id="datatable-buttons">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('address') ?></th>
                    <th><?= $this->Paginator->sort('phone1') ?></th>
                    <th><?= $this->Paginator->sort('phone2') ?></th>
                    <th><?= $this->Paginator->sort('email') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($suppliers as $supplier): ?>
                <tr>
                    <td><?= $this->Number->format($supplier->id) ?></td>
                    <td><?= h($supplier->name) ?></td>
                    <td><?= h($supplier->address) ?></td>
                    <td><?= h($supplier->phone1) ?></td>
                    <td><?= h($supplier->phone2) ?></td>
                    <td><?= h($supplier->email) ?></td>
                    <td><?= h($supplier->created) ?></td>
                    <td><?= h($supplier->modified) ?></td>
                    <td><?= h($supplier->createdby) ?></td>
                    <td><?= h($supplier->modifiedby) ?></td>
                    <td><?= h($supplier->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $supplier->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $supplier->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $supplier->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>