<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MaintenanceRecord $maintenanceRecord
 * @var \Cake\Collection\CollectionInterface|string[] $equipments
 */
$this->set('title_2', 'Maintenance Records');
$emptyText = "Veuillez selectionner";
$maintenance_type = ['Preventive' => 'Preventive', 'Corrective' => 'Corrective', 'Predictive' => 'Predictive', 'Urgence' => 'Urgence'];
$maintenance_status = ['Programmée' => 'Programmée', 'En cours' => 'En cours', 'Terminée' => 'Terminée', 'Annulée' => 'Annulée'];
?>
<div class="mt-3">
    <?= $this->Form->create($maintenanceRecord) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('maintenance_type', ['empty' => $emptyText, 'options' => $maintenance_type, 'class' => 'form-control', 'label' => 'Type Maintenance']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('equipment_id', ['options' => $equipments, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'Equipement']); ?>
            </div>
            <div class="col-xl-6">
                <?= $this->Form->control('scheduled_date', ['empty' => true, 'class' => 'form-control', 'label' => 'Date Programmee']); ?>
            </div>
            <div class="col-xl-6">
                <?= $this->Form->control('completion_date', ['empty' => true, 'class' => 'form-control', 'label' => 'Date Execution']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('description', ['class' => 'form-control', 'label' => 'Description']); ?>
            </div>
            <div class="col-xl-6">
                <?= $this->Form->control('findings', ['class' => 'form-control', 'label' => 'Constats']); ?>
            </div>
            <div class="col-xl-6">
                <?= $this->Form->control('recommendations', ['class' => 'form-control', 'label' => 'Recommendations']); ?>
            </div>
            <div class="col-xl-4">
                <?= $this->Form->control('maintenance_status', ['empty' => $emptyText, 'options' => $maintenance_status, 'class' => 'form-control', 'label' => 'Status']); ?>
            </div>
            <div class="col-xl-4">
                <?= $this->Form->control('cost', ['class' => 'form-control', 'label' => 'Coût']); ?>
            </div>
            <div class="col-xl-4">
                <?= $this->Form->control('downtime_hours', ['class' => 'form-control', 'label' => 'Temps d\'arrets']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Enregistrer'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
