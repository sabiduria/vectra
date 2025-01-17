<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Paymentstosupplier $paymentstosupplier
 * @var \Cake\Collection\CollectionInterface|string[] $purchases
 */
?>
<div class="mt-3">
    <?= $this->Form->create($paymentstosupplier) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('purchase_id', ['options' => $purchases, 'class' => 'form-select select2', 'label' => 'purchase_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('amount', ['class' => 'form-control', 'label' => 'amount']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
