<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Expensestype $expensestype
 */
 $this->set('title_2', 'Expensestypes');
?>
<div class="row">
    <div class="column column-80">
        <div class="expensestypes view content">
            <h3><?= h($expensestype->name) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($expensestype->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($expensestype->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($expensestype->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($expensestype->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Monthy Amount') ?></th>
                    <td><?= $expensestype->monthy_amount === null ? '' : $this->Number->format($expensestype->monthy_amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($expensestype->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($expensestype->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $expensestype->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($expensestype->description)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Expenses') ?></h4>
                <?php if (!empty($expensestype->expenses)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Shop Id') ?></th>
                            <th><?= __('Expensestype Id') ?></th>
                            <th><?= __('Amount') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($expensestype->expenses as $expense) : ?>
                        <tr>
                            <td><?= h($expense->id) ?></td>
                            <td><?= h($expense->shop_id) ?></td>
                            <td><?= h($expense->expensestype_id) ?></td>
                            <td><?= h($expense->amount) ?></td>
                            <td><?= h($expense->description) ?></td>
                            <td><?= h($expense->created) ?></td>
                            <td><?= h($expense->modified) ?></td>
                            <td><?= h($expense->createdby) ?></td>
                            <td><?= h($expense->modifiedby) ?></td>
                            <td><?= h($expense->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('Details'), ['controller' => 'Expenses', 'action' => 'view', $expense->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Editer'), ['controller' => 'Expenses', 'action' => 'edit', $expense->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Expenses', 'action' => 'delete', $expense->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>