<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Paymentstosupplier> $paymentstosuppliers
 */
$this->set('title_2', 'Paymentstosuppliers');
?>
<div class="mt-3">
    <?= $this->Html->link(__('New Paymentstosupplier'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('purchase_id') ?></th>
                    <th><?= $this->Paginator->sort('amount') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($paymentstosuppliers as $paymentstosupplier): ?>
                <tr>
                    <td><?= $this->Number->format($paymentstosupplier->id) ?></td>
                    <td><?= $paymentstosupplier->hasValue('purchase') ? $this->Html->link($paymentstosupplier->purchase->id, ['controller' => 'Purchases', 'action' => 'view', $paymentstosupplier->purchase->id]) : '' ?></td>
                    <td><?= $paymentstosupplier->amount === null ? '' : $this->Number->format($paymentstosupplier->amount) ?></td>
                    <td><?= h($paymentstosupplier->created) ?></td>
                    <td><?= h($paymentstosupplier->modified) ?></td>
                    <td><?= h($paymentstosupplier->createdby) ?></td>
                    <td><?= h($paymentstosupplier->modifiedby) ?></td>
                    <td><?= h($paymentstosupplier->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $paymentstosupplier->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $paymentstosupplier->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $paymentstosupplier->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>