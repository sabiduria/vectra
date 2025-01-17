<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Leave $leave
 * @var string[]|\Cake\Collection\CollectionInterface $users
 * @var string[]|\Cake\Collection\CollectionInterface $leavestypes
 * @var string[]|\Cake\Collection\CollectionInterface $statuses
 */
?>
<div class="mt-3">
    <?= $this->Form->create($leave) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('user_id', ['options' => $users, 'class' => 'form-select select2', 'label' => 'user_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('leavestype_id', ['options' => $leavestypes, 'class' => 'form-select select2', 'label' => 'leavestype_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('status_id', ['options' => $statuses, 'empty' => true, 'class' => 'form-select select2', 'label' => 'status_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('startdate', ['empty' => true, 'class' => 'form-control', 'label' => 'startdate']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('enddate', ['empty' => true, 'class' => 'form-control', 'label' => 'enddate']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('reason', ['class' => 'form-control', 'label' => 'reason']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('approvedby', ['class' => 'form-control', 'label' => 'approvedby']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('approveddate', ['empty' => true, 'class' => 'form-control', 'label' => 'approveddate']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
