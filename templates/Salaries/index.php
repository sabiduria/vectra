<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Salary> $salaries
 */
$this->set('title_2', 'Salaries');
?>
<div class="mt-3">
    <?= $this->Html->link(__('New Salary'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
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
                <?php foreach ($salaries as $salary): ?>
                <tr>
                    <td><?= $this->Number->format($salary->id) ?></td>
                    <td><?= $salary->hasValue('user') ? $this->Html->link($salary->user->id, ['controller' => 'Users', 'action' => 'view', $salary->user->id]) : '' ?></td>
                    <td><?= $salary->amount === null ? '' : $this->Number->format($salary->amount) ?></td>
                    <td><?= h($salary->created) ?></td>
                    <td><?= h($salary->modified) ?></td>
                    <td><?= h($salary->createdby) ?></td>
                    <td><?= h($salary->modifiedby) ?></td>
                    <td><?= h($salary->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $salary->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $salary->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $salary->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>