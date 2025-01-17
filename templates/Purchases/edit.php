<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Purchase $purchase
 * @var string[]|\Cake\Collection\CollectionInterface $statuses
 * @var string[]|\Cake\Collection\CollectionInterface $suppliers
 */
?>
<div class="mt-3">
    <?= $this->Form->create($purchase) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('status_id', ['options' => $statuses, 'empty' => true, 'class' => 'form-select select2', 'label' => 'status_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('supplier_id', ['options' => $suppliers, 'class' => 'form-select select2', 'label' => 'supplier_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('reference', ['class' => 'form-control', 'label' => 'reference']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('qty', ['class' => 'form-control', 'label' => 'qty']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('receipt_date', ['empty' => true, 'class' => 'form-control', 'label' => 'receipt_date']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
