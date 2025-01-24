<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Sale> $sales
 */
$this->set('title_2', 'Sales');
$Number = 1;
?>
<div class="mt-3">
    <?= $this->Html->link(__('Nouveau Sale'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('N°') ?></th>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('customer_id') ?></th>
                    <th><?= $this->Paginator->sort('reference') ?></th>
                    <th><?= $this->Paginator->sort('total_amount') ?></th>
                    <th><?= $this->Paginator->sort('payment_method') ?></th>
                    <th><?= $this->Paginator->sort('status_id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sales as $sale): ?>
                <tr>
                    <td><?= $Number++ ?></td>
                    <td><?= $this->Number->format($sale->id) ?></td>
                    <td><?= $sale->hasValue('user') ? $this->Html->link($sale->user->id, ['controller' => 'Users', 'action' => 'view', $sale->user->id]) : '' ?></td>
                    <td><?= $sale->hasValue('customer') ? $this->Html->link($sale->customer->name, ['controller' => 'Customers', 'action' => 'view', $sale->customer->id]) : '' ?></td>
                    <td><?= h($sale->reference) ?></td>
                    <td><?= $sale->total_amount === null ? '' : $this->Number->format($sale->total_amount) ?></td>
                    <td><?= h($sale->payment_method) ?></td>
                    <td><?= $sale->hasValue('status') ? $this->Html->link($sale->status->name, ['controller' => 'Statuses', 'action' => 'view', $sale->status->id]) : '' ?></td>
                    <td><?= h($sale->created) ?></td>
                    <td><?= h($sale->modified) ?></td>
                    <td><?= h($sale->createdby) ?></td>
                    <td><?= h($sale->modifiedby) ?></td>
                    <td><?= h($sale->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Details'), ['action' => 'view', $sale->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Editer'), ['action' => 'edit', $sale->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $sale->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>