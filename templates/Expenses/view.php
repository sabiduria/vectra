<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Expense $expense
 */
?>
<div class="row">
    <div class="column column-80">
        <div class="expenses view content">
            <h3><?= h($expense->id) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Shop') ?></th>
                    <td><?= $expense->hasValue('shop') ? $this->Html->link($expense->shop->name, ['controller' => 'Shops', 'action' => 'view', $expense->shop->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Expensestype') ?></th>
                    <td><?= $expense->hasValue('expensestype') ? $this->Html->link($expense->expensestype->name, ['controller' => 'Expensestypes', 'action' => 'view', $expense->expensestype->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($expense->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($expense->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($expense->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Amount') ?></th>
                    <td><?= $expense->amount === null ? '' : $this->Number->format($expense->amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($expense->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($expense->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $expense->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($expense->description)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>