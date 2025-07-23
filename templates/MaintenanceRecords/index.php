<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\MaintenanceRecord> $maintenanceRecords
 */
$this->set('title_2', 'Maintenances');
$Number = 1;
$emptyText = "Veuillez selectionner";
?>
<div class="mt-3">
    <?= $this->Html->link(__('Nouvelle Maintenance'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100 TableData">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('N°') ?></th>
                    <th><?= $this->Paginator->sort('Type') ?></th>
                    <th><?= $this->Paginator->sort('Equipement') ?></th>
                    <th><?= $this->Paginator->sort('Date Maintenance') ?></th>
                    <th><?= $this->Paginator->sort('Status') ?></th>
                    <th><?= $this->Paginator->sort('Cout') ?></th>
                    <th><?= $this->Paginator->sort('Date') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($maintenanceRecords as $maintenanceRecord): ?>
                <tr>
                    <td><?= $Number++ ?></td>
                    <td><?= h($maintenanceRecord->maintenance_type) ?></td>
                    <td><?= $maintenanceRecord->hasValue('equipment') ? $this->Html->link($maintenanceRecord->equipment->name, ['controller' => 'Equipments', 'action' => 'view', $maintenanceRecord->equipment->id]) : '' ?></td>
                    <td>
                        <strong>Date Programmee : </strong> <?= h($maintenanceRecord->scheduled_date) ?> <br>
                        <strong>Date Execution : </strong> <?= h($maintenanceRecord->completion_date) ?> <br>
                        <strong>Temps d'arret : </strong> <?= h($maintenanceRecord->downtime_hours) ?>
                    </td>
                    <td><?= h($maintenanceRecord->maintenance_status) ?></td>
                    <td><?= $maintenanceRecord->cost === null ? '' : $this->Number->format($maintenanceRecord->cost) ?></td>
                    <td><?= h($maintenanceRecord->created) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Details'), ['action' => 'view', $maintenanceRecord->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <!--?= $this->Html->link(__('Editer'), ['action' => 'edit', $maintenanceRecord->id], ['class' => 'btn btn-primary btn-sm']) ?-->
                        <!--?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $maintenanceRecord->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?-->
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
