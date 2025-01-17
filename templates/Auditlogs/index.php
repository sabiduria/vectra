<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Auditlog> $auditlogs
 */
?>
<div class="mt-3">
    <?= $this->Html->link(__('New Auditlog'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']) ?>
    <h3><?= __('Auditlogs') ?></h3>
    <div class="table-responsive">
        <table class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" id="datatable-buttons">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('event_type') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($auditlogs as $auditlog): ?>
                <tr>
                    <td><?= $this->Number->format($auditlog->id) ?></td>
                    <td><?= h($auditlog->event_type) ?></td>
                    <td><?= h($auditlog->created) ?></td>
                    <td><?= h($auditlog->modified) ?></td>
                    <td><?= h($auditlog->createdby) ?></td>
                    <td><?= h($auditlog->modifiedby) ?></td>
                    <td><?= h($auditlog->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $auditlog->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $auditlog->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $auditlog->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>