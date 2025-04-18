<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Expense> $expenses
 */
$this->set('title_2', 'Depenses');
$Number = 1;
?>
<div class="mt-3">
    <?= $this->Html->link(__('Nouvelle dépense'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100 TableData">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('N°') ?></th>
                    <th><?= $this->Paginator->sort('Shop') ?></th>
                    <th><?= $this->Paginator->sort('Type') ?></th>
                    <th><?= $this->Paginator->sort('Description') ?></th>
                    <th><?= $this->Paginator->sort('Montant') ?></th>
                    <th><?= $this->Paginator->sort('Date') ?></th>
                    <th><?= $this->Paginator->sort('Par') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($expenses as $expense) : ?>
                <tr>
                    <td><?= $Number++ ?></td>
                    <td><?= $expense->shop->name ?></td>
                    <td><?= $expense->expensestype->name ?></td>
                    <td><?= $expense->description ?></td>
                    <td><?= $this->Number->format($expense->amount) ?></td>
                    <td><?= h($expense->created) ?></td>
                    <td><?= h($expense->createdby) ?></td>
                    <td class="text-end">
                        <?= $this->Html->link(__('<i class="ri-pencil-line"></i>'), ['action' => 'edit', $expense->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                        <?= $this->Form->postLink(__('<i class="ri-delete-bin-line"></i>'), ['action' => 'delete', $expense->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?'), 'escape' => false]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
