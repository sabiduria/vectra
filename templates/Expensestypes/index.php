<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Expensestype> $expensestypes
 */
$this->set('title_2', 'Expensestypes');
?>
<div class="mt-3">
    <?= $this->Html->link(__('New Expensestype'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('monthy_amount') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($expensestypes as $expensestype): ?>
                <tr>
                    <td><?= $this->Number->format($expensestype->id) ?></td>
                    <td><?= h($expensestype->name) ?></td>
                    <td><?= $expensestype->monthy_amount === null ? '' : $this->Number->format($expensestype->monthy_amount) ?></td>
                    <td><?= h($expensestype->created) ?></td>
                    <td><?= h($expensestype->modified) ?></td>
                    <td><?= h($expensestype->createdby) ?></td>
                    <td><?= h($expensestype->modifiedby) ?></td>
                    <td><?= h($expensestype->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $expensestype->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $expensestype->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $expensestype->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>