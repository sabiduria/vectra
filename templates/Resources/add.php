<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Resource $resource
 */
$this->set('title_2', 'Resources');
$emptyText = "Veuillez selectionner";
$this->set('menu_parameters', 'active open');
?>
<div class="mt-3">
    <?= $this->Form->create($resource) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('name', ['class' => 'form-control', 'label' => 'name']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('generic_name', ['class' => 'form-control', 'label' => 'generic_name']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('icon', ['class' => 'form-control', 'label' => 'icon']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Enregistrer'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
