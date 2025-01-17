<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
$this->set('title_2', 'Users');
$emptyText = "Please select";
?>
<div class="mt-3">
    <?= $this->Form->create($user) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('firstname', ['class' => 'form-control', 'label' => 'firstname']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('lastname', ['class' => 'form-control', 'label' => 'lastname']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('address', ['class' => 'form-control', 'label' => 'address']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('phone1', ['class' => 'form-control', 'label' => 'phone1']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('phone2', ['class' => 'form-control', 'label' => 'phone2']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('leave_days_month', ['class' => 'form-control', 'label' => 'leave_days_month']); ?>
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
