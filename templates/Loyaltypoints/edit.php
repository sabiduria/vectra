<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Loyaltypoint $loyaltypoint
 * @var string[]|\Cake\Collection\CollectionInterface $customers
 */
$this->set('title_2', 'Loyaltypoints');
$emptyText = "Veuillez selectionner";
?>
<div class="mt-3">
    <?= $this->Form->create($loyaltypoint) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('customer_id', ['options' => $customers, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'customer_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('issuedpoints', ['class' => 'form-control', 'label' => 'issuedpoints']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('redeemedpoints', ['class' => 'form-control', 'label' => 'redeemedpoints']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
