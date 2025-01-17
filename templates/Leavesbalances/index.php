<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Leavesbalance> $leavesbalances
 */
$this->set('title_2', 'Leavesbalances');
?>
<div class="mt-3">
    <?= $this->Html->link(__('New Leavesbalance'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('leavestype_id') ?></th>
                    <th><?= $this->Paginator->sort('available_balance') ?></th>
                    <th><?= $this->Paginator->sort('balance_year') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($leavesbalances as $leavesbalance): ?>
                <tr>
                    <td><?= $this->Number->format($leavesbalance->id) ?></td>
                    <td><?= $leavesbalance->hasValue('user') ? $this->Html->link($leavesbalance->user->id, ['controller' => 'Users', 'action' => 'view', $leavesbalance->user->id]) : '' ?></td>
                    <td><?= $leavesbalance->hasValue('leavestype') ? $this->Html->link($leavesbalance->leavestype->name, ['controller' => 'Leavestypes', 'action' => 'view', $leavesbalance->leavestype->id]) : '' ?></td>
                    <td><?= $leavesbalance->available_balance === null ? '' : $this->Number->format($leavesbalance->available_balance) ?></td>
                    <td><?= $leavesbalance->balance_year === null ? '' : $this->Number->format($leavesbalance->balance_year) ?></td>
                    <td><?= h($leavesbalance->created) ?></td>
                    <td><?= h($leavesbalance->modified) ?></td>
                    <td><?= h($leavesbalance->createdby) ?></td>
                    <td><?= h($leavesbalance->modifiedby) ?></td>
                    <td><?= h($leavesbalance->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $leavesbalance->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $leavesbalance->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $leavesbalance->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>