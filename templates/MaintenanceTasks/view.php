<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MaintenanceTask $maintenanceTask
 */
 $this->set('title_2', 'Maintenance Tasks');
?>
<div class="row">
    <div class="column column-80">
        <div class="maintenanceTasks view content">
            <h3><?= h($maintenanceTask->id) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Maintenance Record') ?></th>
                    <td><?= $maintenanceTask->hasValue('maintenance_record') ? $this->Html->link($maintenanceTask->maintenance_record->id, ['controller' => 'MaintenanceRecords', 'action' => 'view', $maintenanceTask->maintenance_record->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Tasks Status') ?></th>
                    <td><?= h($maintenanceTask->tasks_status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($maintenanceTask->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($maintenanceTask->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($maintenanceTask->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Hours Spent') ?></th>
                    <td><?= $maintenanceTask->hours_spent === null ? '' : $this->Number->format($maintenanceTask->hours_spent) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($maintenanceTask->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($maintenanceTask->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $maintenanceTask->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Task Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($maintenanceTask->task_description)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Notes') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($maintenanceTask->notes)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>