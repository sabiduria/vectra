<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Leave> $leaves
 */
?>
<div class="mt-3">
    <?= $this->Html->link(__('New Leave'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']) ?>
    <h3><?= __('Leaves') ?></h3>
    <div class="table-responsive">
        <table class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" id="datatable-buttons">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('leavestype_id') ?></th>
                    <th><?= $this->Paginator->sort('status_id') ?></th>
                    <th><?= $this->Paginator->sort('startdate') ?></th>
                    <th><?= $this->Paginator->sort('enddate') ?></th>
                    <th><?= $this->Paginator->sort('approvedby') ?></th>
                    <th><?= $this->Paginator->sort('approveddate') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($leaves as $leave): ?>
                <tr>
                    <td><?= $this->Number->format($leave->id) ?></td>
                    <td><?= $leave->hasValue('user') ? $this->Html->link($leave->user->id, ['controller' => 'Users', 'action' => 'view', $leave->user->id]) : '' ?></td>
                    <td><?= $leave->hasValue('leavestype') ? $this->Html->link($leave->leavestype->name, ['controller' => 'Leavestypes', 'action' => 'view', $leave->leavestype->id]) : '' ?></td>
                    <td><?= $leave->hasValue('status') ? $this->Html->link($leave->status->name, ['controller' => 'Statuses', 'action' => 'view', $leave->status->id]) : '' ?></td>
                    <td><?= h($leave->startdate) ?></td>
                    <td><?= h($leave->enddate) ?></td>
                    <td><?= h($leave->approvedby) ?></td>
                    <td><?= h($leave->approveddate) ?></td>
                    <td><?= h($leave->created) ?></td>
                    <td><?= h($leave->modified) ?></td>
                    <td><?= h($leave->createdby) ?></td>
                    <td><?= h($leave->modifiedby) ?></td>
                    <td><?= h($leave->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $leave->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $leave->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $leave->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>