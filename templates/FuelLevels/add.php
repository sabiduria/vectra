<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FuelLevel $fuelLevel
 * @var \Cake\Collection\CollectionInterface|string[] $equipments
 */
$this->set('title_2', 'Fuel Levels');
$emptyText = "Veuillez selectionner";
?>
<div class="mt-3">
    <?= $this->Form->create($fuelLevel) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('equipment_id', ['options' => $equipments, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'equipment_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('current_level', ['class' => 'form-control', 'label' => 'current_level']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Enregistrer'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
