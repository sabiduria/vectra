<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Leave $leave
 * @var \Cake\Collection\CollectionInterface|string[] $users
 * @var \Cake\Collection\CollectionInterface|string[] $leavestypes
 * @var \Cake\Collection\CollectionInterface|string[] $statuses
 */
$this->set('title_2', 'Leaves');
$emptyText = "Veuillez selectionner";
$this->set('menu_attendances', 'active open');
?>
<div class="mt-3">
    <?= $this->Form->create($leave) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('user_id', ['options' => $users, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'user_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('leavestype_id', ['options' => $leavestypes, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'leavestype_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('status_id', ['options' => $statuses, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'status_id']); ?>
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
            <?= $this->Form->button(__('Enregistrer'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
