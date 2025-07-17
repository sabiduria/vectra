<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Equipment $equipment
 */
$this->set('title_2', 'Equipments');
$emptyText = "Veuillez selectionner";
?>
<div class="mt-3">
    <?= $this->Form->create($equipment) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('name', ['class' => 'form-control', 'label' => 'name']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('serial_number', ['class' => 'form-control', 'label' => 'serial_number']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('equipment_model', ['class' => 'form-control', 'label' => 'equipment_model']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('manufacturer', ['class' => 'form-control', 'label' => 'manufacturer']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('purchase_date', ['empty' => true, 'class' => 'form-control', 'label' => 'purchase_date']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('warranty_expiration', ['empty' => true, 'class' => 'form-control', 'label' => 'warranty_expiration']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('equipment_status', ['class' => 'form-control', 'label' => 'equipment_status']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('last_maintenance_date', ['empty' => true, 'class' => 'form-control', 'label' => 'last_maintenance_date']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('next_maintenance_date', ['empty' => true, 'class' => 'form-control', 'label' => 'next_maintenance_date']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('maintenance_frequency', ['class' => 'form-control', 'label' => 'maintenance_frequency']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('maximum_fuel', ['class' => 'form-control', 'label' => 'maximum_fuel']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('minimum_fuel', ['class' => 'form-control', 'label' => 'minimum_fuel']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('tracked_fuel', ['class' => 'form-control', 'label' => 'tracked_fuel']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Enregistrer'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
