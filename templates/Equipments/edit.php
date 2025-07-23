<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Equipment $equipment
 */
$this->set('title_2', 'Equipments');
$emptyText = "Veuillez selectionner";
$status = ['Actif' => 'Actif', 'Inactif' => 'Inactif', 'Hors Service' => 'Hors Service', 'En Maintenance' => 'En Maintenance'];
?>
<div class="mt-3">
    <?= $this->Form->create($equipment) ?>
    <div class="row gy-2">
        <div class="col-xl-12">
            <?= $this->Form->control('name', ['class' => 'form-control', 'label' => 'Designation']); ?>
        </div>
        <div class="col-xl-4">
            <?= $this->Form->control('serial_number', ['class' => 'form-control', 'label' => 'N° Serie']); ?>
        </div>
        <div class="col-xl-4">
            <?= $this->Form->control('equipment_model', ['class' => 'form-control', 'label' => 'Modele']); ?>
        </div>
        <div class="col-xl-4">
            <?= $this->Form->control('manufacturer', ['class' => 'form-control', 'label' => 'Fabricant']); ?>
        </div>
        <div class="col-xl-6">
            <?= $this->Form->control('purchase_date', ['empty' => true, 'class' => 'form-control', 'label' => 'Date Acquisition']); ?>
        </div>
        <div class="col-xl-6">
            <?= $this->Form->control('warranty_expiration', ['empty' => true, 'class' => 'form-control', 'label' => 'Expiration Garantie']); ?>
        </div>
        <div class="col-xl-12">
            <?= $this->Form->control('equipment_status', ['options' => $status, 'class' => 'form-select', 'label' => 'Status']); ?>
        </div>
        <div class="col-xl-5">
            <?= $this->Form->control('last_maintenance_date', ['empty' => true, 'class' => 'form-control', 'label' => 'Derniere Maintenance']); ?>
        </div>
        <div class="col-xl-5">
            <?= $this->Form->control('next_maintenance_date', ['empty' => true, 'class' => 'form-control', 'label' => 'Prochaine Maintenance']); ?>
        </div>
        <div class="col-xl-2">
            <?= $this->Form->control('maintenance_frequency', ['class' => 'form-control', 'label' => 'Freq. de Maintenance']); ?>
        </div>
        <div class="col-xl-6">
            <?= $this->Form->control('maximum_fuel', ['class' => 'form-control', 'label' => 'Carburant Maximum (Optionel)']); ?>
        </div>
        <div class="col-xl-6">
            <?= $this->Form->control('minimum_fuel', ['class' => 'form-control', 'label' => 'Carburant Minimum (Optionel)']); ?>
        </div>
    </div>
    <div class="mt-3 mb-3">
        <?= $this->Form->button(__('Enregistrer'), ['class'=>'btn btn-success']) ?>
    </div>
    <?= $this->Form->end() ?>
</div>
