<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Supplier $supplier
 */
$this->set('title_2', 'Fournisseurs');
$emptyText = "Veuillez selectionner";
?>
<div class="mt-3">
    <?= $this->Form->create($supplier) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('name', ['class' => 'form-control', 'label' => 'Designation']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('address', ['class' => 'form-control', 'label' => 'Adresse']); ?>
            </div>
            <div class="col-xl-6">
                <?= $this->Form->control('phone1', ['class' => 'form-control', 'label' => 'Tel 1']); ?>
            </div>
            <div class="col-xl-6">
                <?= $this->Form->control('phone2', ['class' => 'form-control', 'label' => 'Tel 2']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('email', ['class' => 'form-control', 'label' => 'Email']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Enregistrer'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
