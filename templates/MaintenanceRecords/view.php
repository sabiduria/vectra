<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MaintenanceRecord $maintenanceRecord
 */
 $this->set('title_2', 'Maintenance Records');
?>
<div class="row">
    <div class="column column-80">
        <div class="maintenanceRecords view content">
            <h3><?= h($maintenanceRecord->id) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Maintenance Type') ?></th>
                    <td><?= h($maintenanceRecord->maintenance_type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Equipment') ?></th>
                    <td><?= $maintenanceRecord->hasValue('equipment') ? $this->Html->link($maintenanceRecord->equipment->name, ['controller' => 'Equipments', 'action' => 'view', $maintenanceRecord->equipment->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Maintenance Status') ?></th>
                    <td><?= h($maintenanceRecord->maintenance_status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($maintenanceRecord->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($maintenanceRecord->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($maintenanceRecord->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Cost') ?></th>
                    <td><?= $maintenanceRecord->cost === null ? '' : $this->Number->format($maintenanceRecord->cost) ?></td>
                </tr>
                <tr>
                    <th><?= __('Downtime Hours') ?></th>
                    <td><?= $maintenanceRecord->downtime_hours === null ? '' : $this->Number->format($maintenanceRecord->downtime_hours) ?></td>
                </tr>
                <tr>
                    <th><?= __('Scheduled Date') ?></th>
                    <td><?= h($maintenanceRecord->scheduled_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Completion Date') ?></th>
                    <td><?= h($maintenanceRecord->completion_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($maintenanceRecord->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($maintenanceRecord->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $maintenanceRecord->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($maintenanceRecord->description)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Findings') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($maintenanceRecord->findings)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Recommendations') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($maintenanceRecord->recommendations)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Maintenance Tasks') ?></h4>
                <?php if (!empty($maintenanceRecord->maintenance_tasks)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Maintenance Record Id') ?></th>
                            <th><?= __('Task Description') ?></th>
                            <th><?= __('Tasks Status') ?></th>
                            <th><?= __('Notes') ?></th>
                            <th><?= __('Hours Spent') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($maintenanceRecord->maintenance_tasks as $maintenanceTask) : ?>
                        <tr>
                            <td><?= h($maintenanceTask->id) ?></td>
                            <td><?= h($maintenanceTask->maintenance_record_id) ?></td>
                            <td><?= h($maintenanceTask->task_description) ?></td>
                            <td><?= h($maintenanceTask->tasks_status) ?></td>
                            <td><?= h($maintenanceTask->notes) ?></td>
                            <td><?= h($maintenanceTask->hours_spent) ?></td>
                            <td><?= h($maintenanceTask->created) ?></td>
                            <td><?= h($maintenanceTask->modified) ?></td>
                            <td><?= h($maintenanceTask->createdby) ?></td>
                            <td><?= h($maintenanceTask->modifiedby) ?></td>
                            <td><?= h($maintenanceTask->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('Details'), ['controller' => 'MaintenanceTasks', 'action' => 'view', $maintenanceTask->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Editer'), ['controller' => 'MaintenanceTasks', 'action' => 'edit', $maintenanceTask->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'MaintenanceTasks', 'action' => 'delete', $maintenanceTask->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Parts Useds') ?></h4>
                <?php if (!empty($maintenanceRecord->parts_useds)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Maintenance Record Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Quantity') ?></th>
                            <th><?= __('Unit Cost') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($maintenanceRecord->parts_useds as $partsUsed) : ?>
                        <tr>
                            <td><?= h($partsUsed->id) ?></td>
                            <td><?= h($partsUsed->maintenance_record_id) ?></td>
                            <td><?= h($partsUsed->name) ?></td>
                            <td><?= h($partsUsed->quantity) ?></td>
                            <td><?= h($partsUsed->unit_cost) ?></td>
                            <td><?= h($partsUsed->created) ?></td>
                            <td><?= h($partsUsed->modified) ?></td>
                            <td><?= h($partsUsed->createdby) ?></td>
                            <td><?= h($partsUsed->modifiedby) ?></td>
                            <td><?= h($partsUsed->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('Details'), ['controller' => 'PartsUseds', 'action' => 'view', $partsUsed->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Editer'), ['controller' => 'PartsUseds', 'action' => 'edit', $partsUsed->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'PartsUseds', 'action' => 'delete', $partsUsed->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
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