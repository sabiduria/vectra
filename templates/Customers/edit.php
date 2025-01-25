<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer $customer
 */
$this->set('title_2', 'Clients');
$emptyText = "Veuillez selectionner";
?>
<div class="mt-3">
    <?= $this->Form->create($customer) ?>
    <div class="row gy-2">
        <div class="col-xl-12">
            <?= $this->Form->control('name', ['class' => 'form-control', 'label' => 'Nom']); ?>
        </div>
        <div class="col-xl-12">
            <?= $this->Form->control('phone', ['class' => 'form-control', 'label' => 'Telephone']); ?>
        </div>
        <div class="col-xl-6">
            <?= $this->Form->control('username', ['class' => 'form-control', 'label' => 'Username']); ?>
        </div>
        <div class="col-xl-6">
            <?= $this->Form->control('password', ['class' => 'form-control', 'label' => 'Password']); ?>
        </div>
    </div>
    <div class="mt-3 mb-3">
        <?= $this->Form->button(__('Enregistrer'), ['class'=>'btn btn-success']) ?>
    </div>
    <?= $this->Form->end() ?>
</div>
