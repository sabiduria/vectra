<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Invproduct $invproduct
 * @var string[]|\Cake\Collection\CollectionInterface $users
 * @var string[]|\Cake\Collection\CollectionInterface $statuses
 */
$this->set('title_2', 'Invproducts');
$emptyText = "Veuillez selectionner";
?>
<div class="mt-3">
    <?= $this->Form->create($invproduct) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('reference', ['class' => 'form-control', 'label' => 'reference']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('inventory_period', ['class' => 'form-control', 'label' => 'inventory_period']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('start_date', ['empty' => true, 'class' => 'form-control', 'label' => 'start_date']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('end_date', ['empty' => true, 'class' => 'form-control', 'label' => 'end_date']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('user_id', ['options' => $users, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'user_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('status_id', ['options' => $statuses, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'status_id']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Enregistrer'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
