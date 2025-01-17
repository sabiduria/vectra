<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Expense> $expenses
 */
$this->set('title_2', 'Expenses');
?>
<div class="mt-3">
    <?= $this->Html->link(__('New Expense'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('shop_id') ?></th>
                    <th><?= $this->Paginator->sort('expensestype_id') ?></th>
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
                <?php foreach ($expenses as $expense): ?>
                <tr>
                    <td><?= $this->Number->format($expense->id) ?></td>
                    <td><?= $expense->hasValue('shop') ? $this->Html->link($expense->shop->name, ['controller' => 'Shops', 'action' => 'view', $expense->shop->id]) : '' ?></td>
                    <td><?= $expense->hasValue('expensestype') ? $this->Html->link($expense->expensestype->name, ['controller' => 'Expensestypes', 'action' => 'view', $expense->expensestype->id]) : '' ?></td>
                    <td><?= $expense->amount === null ? '' : $this->Number->format($expense->amount) ?></td>
                    <td><?= h($expense->created) ?></td>
                    <td><?= h($expense->modified) ?></td>
                    <td><?= h($expense->createdby) ?></td>
                    <td><?= h($expense->modifiedby) ?></td>
                    <td><?= h($expense->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $expense->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $expense->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $expense->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>