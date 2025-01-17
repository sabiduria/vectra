<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Leavesbalance $leavesbalance
 * @var string[]|\Cake\Collection\CollectionInterface $users
 * @var string[]|\Cake\Collection\CollectionInterface $leavestypes
 */
?>
<div class="mt-3">
    <?= $this->Form->create($leavesbalance) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('user_id', ['options' => $users, 'class' => 'form-select select2', 'label' => 'user_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('leavestype_id', ['options' => $leavestypes, 'class' => 'form-select select2', 'label' => 'leavestype_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('available_balance', ['class' => 'form-control', 'label' => 'available_balance']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('balance_year', ['class' => 'form-control', 'label' => 'balance_year']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
