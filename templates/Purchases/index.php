<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Purchase> $purchases
 */
$this->set('title_2', 'Purchases');
$Number = 1;
?>
<div class="mt-3">
    <?= $this->Html->link(__('Nouveau Purchase'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('N°') ?></th>
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
                    <td><?= $Number++ ?></td>
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
                        <?= $this->Html->link(__('Details'), ['action' => 'view', $purchase->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Editer'), ['action' => 'edit', $purchase->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $purchase->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>