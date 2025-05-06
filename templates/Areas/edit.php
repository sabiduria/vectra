<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Area $area
 */
$this->set('title_2', 'Zones de ventes');
$emptyText = "Veuillez selectionner";
$this->set('menu_warehouse', 'active open');
?>
<div class="mt-3">
    <?= $this->Form->create($area) ?>
    <div class="row gy-2">
        <div class="col-xl-12">
            <?= $this->Form->control('name', ['class' => 'form-control', 'label' => 'Designation']); ?>
        </div>
        <div class="col-xl-12">
            <?= $this->Form->control('description', ['type' => 'textarea', 'class' => 'form-control', 'label' => 'Description ou Adresse']); ?>
        </div>
    </div>
    <div class="mt-3 mb-3">
        <?= $this->Form->button(__('Enregistrer'), ['class'=>'btn btn-success']) ?>
    </div>
    <?= $this->Form->end() ?>
</div>
