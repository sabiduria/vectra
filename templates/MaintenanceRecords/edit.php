<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MaintenanceRecord $maintenanceRecord
 * @var string[]|\Cake\Collection\CollectionInterface $equipments
 */
$this->set('title_2', 'Maintenance Records');
$emptyText = "Veuillez selectionner";
?>
<div class="mt-3">
    <?= $this->Form->create($maintenanceRecord) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('maintenance_type', ['class' => 'form-control', 'label' => 'maintenance_type']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('equipment_id', ['options' => $equipments, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'equipment_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('scheduled_date', ['empty' => true, 'class' => 'form-control', 'label' => 'scheduled_date']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('completion_date', ['empty' => true, 'class' => 'form-control', 'label' => 'completion_date']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('maintenance_status', ['class' => 'form-control', 'label' => 'maintenance_status']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('description', ['class' => 'form-control', 'label' => 'description']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('findings', ['class' => 'form-control', 'label' => 'findings']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('recommendations', ['class' => 'form-control', 'label' => 'recommendations']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('cost', ['class' => 'form-control', 'label' => 'cost']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('downtime_hours', ['class' => 'form-control', 'label' => 'downtime_hours']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Enregistrer'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
