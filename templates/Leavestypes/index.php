<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Leavestype> $leavestypes
 */
?>
<div class="mt-3">
    <?= $this->Html->link(__('New Leavestype'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']) ?>
    <h3><?= __('Leavestypes') ?></h3>
    <div class="table-responsive">
        <table class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" id="datatable-buttons">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('maxdaysperyear') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($leavestypes as $leavestype): ?>
                <tr>
                    <td><?= $this->Number->format($leavestype->id) ?></td>
                    <td><?= h($leavestype->name) ?></td>
                    <td><?= $leavestype->maxdaysperyear === null ? '' : $this->Number->format($leavestype->maxdaysperyear) ?></td>
                    <td><?= h($leavestype->created) ?></td>
                    <td><?= h($leavestype->modified) ?></td>
                    <td><?= h($leavestype->createdby) ?></td>
                    <td><?= h($leavestype->modifiedby) ?></td>
                    <td><?= h($leavestype->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $leavestype->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $leavestype->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $leavestype->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>