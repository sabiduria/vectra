<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Attendancestype> $attendancestypes
 */
?>
<div class="mt-3">
    <?= $this->Html->link(__('New Attendancestype'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']) ?>
    <h3><?= __('Attendancestypes') ?></h3>
    <div class="table-responsive">
        <table class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" id="datatable-buttons">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('penality') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($attendancestypes as $attendancestype): ?>
                <tr>
                    <td><?= $this->Number->format($attendancestype->id) ?></td>
                    <td><?= h($attendancestype->name) ?></td>
                    <td><?= $attendancestype->penality === null ? '' : $this->Number->format($attendancestype->penality) ?></td>
                    <td><?= h($attendancestype->created) ?></td>
                    <td><?= h($attendancestype->modified) ?></td>
                    <td><?= h($attendancestype->createdby) ?></td>
                    <td><?= h($attendancestype->modifiedby) ?></td>
                    <td><?= h($attendancestype->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $attendancestype->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $attendancestype->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $attendancestype->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>