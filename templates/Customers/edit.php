<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer $customer
 */
$this->set('title_2', 'Customers');
$emptyText = "Veuillez selectionner";
?>
<div class="mt-3">
    <?= $this->Form->create($customer) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('name', ['class' => 'form-control', 'label' => 'name']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('phone', ['class' => 'form-control', 'label' => 'phone']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('marketer_id', ['class' => 'form-control', 'label' => 'marketer_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('marketer_name', ['class' => 'form-control', 'label' => 'marketer_name']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('username', ['class' => 'form-control', 'label' => 'username']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('password', ['class' => 'form-control', 'label' => 'password']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
