<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Holiday> $holidays
 */
?>
<div class="mt-3">
    <?= $this->Html->link(__('New Holiday'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']) ?>
    <h3><?= __('Holidays') ?></h3>
    <div class="table-responsive">
        <table class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" id="datatable-buttons">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('holidaydate') ?></th>
                    <th><?= $this->Paginator->sort('description') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($holidays as $holiday): ?>
                <tr>
                    <td><?= $this->Number->format($holiday->id) ?></td>
                    <td><?= h($holiday->holidaydate) ?></td>
                    <td><?= h($holiday->description) ?></td>
                    <td><?= h($holiday->created) ?></td>
                    <td><?= h($holiday->modified) ?></td>
                    <td><?= h($holiday->createdby) ?></td>
                    <td><?= h($holiday->modifiedby) ?></td>
                    <td><?= h($holiday->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $holiday->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $holiday->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $holiday->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>