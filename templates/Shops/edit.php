<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Shop $shop
 * @var string[]|\Cake\Collection\CollectionInterface $areas
 */
$this->set('title_2', 'Shops');
$emptyText = "Veuillez selectionner";
$this->set('menu_warehouse', 'active open');
?>
<div class="mt-3">
    <?= $this->Form->create($shop) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('area_id', ['options' => $areas, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'Zone de vente']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('name', ['class' => 'form-control', 'label' => 'Designation']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('address', ['type' => 'textarea', 'class' => 'form-control', 'label' => 'Adresse']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('phone', ['class' => 'form-control', 'label' => 'Telephone']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Enregistrer'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
