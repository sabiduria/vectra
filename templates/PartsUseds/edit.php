<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PartsUsed $partsUsed
 * @var string[]|\Cake\Collection\CollectionInterface $maintenanceRecords
 */
$this->set('title_2', 'Parts Useds');
$emptyText = "Veuillez selectionner";
?>
<div class="mt-3">
    <?= $this->Form->create($partsUsed) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('maintenance_record_id', ['options' => $maintenanceRecords, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'maintenance_record_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('name', ['class' => 'form-control', 'label' => 'name']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('quantity', ['class' => 'form-control', 'label' => 'quantity']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('unit_cost', ['class' => 'form-control', 'label' => 'unit_cost']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Enregistrer'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
