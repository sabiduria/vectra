<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Attendance> $attendances
 */
$this->set('title_2', 'Attendances');
?>
<div class="mt-3">
    <?= $this->Html->link(__('New Attendance'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('affectation_id') ?></th>
                    <th><?= $this->Paginator->sort('attendancestype_id') ?></th>
                    <th><?= $this->Paginator->sort('check_in') ?></th>
                    <th><?= $this->Paginator->sort('check_out') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($attendances as $attendance): ?>
                <tr>
                    <td><?= $this->Number->format($attendance->id) ?></td>
                    <td><?= $attendance->hasValue('affectation') ? $this->Html->link($attendance->affectation->id, ['controller' => 'Affectations', 'action' => 'view', $attendance->affectation->id]) : '' ?></td>
                    <td><?= $attendance->hasValue('attendancestype') ? $this->Html->link($attendance->attendancestype->name, ['controller' => 'Attendancestypes', 'action' => 'view', $attendance->attendancestype->id]) : '' ?></td>
                    <td><?= h($attendance->check_in) ?></td>
                    <td><?= h($attendance->check_out) ?></td>
                    <td><?= h($attendance->created) ?></td>
                    <td><?= h($attendance->modified) ?></td>
                    <td><?= h($attendance->createdby) ?></td>
                    <td><?= h($attendance->modifiedby) ?></td>
                    <td><?= h($attendance->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $attendance->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $attendance->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $attendance->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>