<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MaintenanceTask $maintenanceTask
 * @var string[]|\Cake\Collection\CollectionInterface $maintenanceRecords
 */
$this->set('title_2', 'Maintenance Tasks');
$emptyText = "Veuillez selectionner";
?>
<div class="mt-3">
    <?= $this->Form->create($maintenanceTask) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('maintenance_record_id', ['options' => $maintenanceRecords, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'maintenance_record_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('task_description', ['class' => 'form-control', 'label' => 'task_description']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('tasks_status', ['class' => 'form-control', 'label' => 'tasks_status']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('notes', ['class' => 'form-control', 'label' => 'notes']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('hours_spent', ['class' => 'form-control', 'label' => 'hours_spent']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Enregistrer'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
