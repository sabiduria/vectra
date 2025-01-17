<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Stockinsdetail $stockinsdetail
 * @var string[]|\Cake\Collection\CollectionInterface $products
 * @var string[]|\Cake\Collection\CollectionInterface $stockins
 */
?>
<div class="mt-3">
    <?= $this->Form->create($stockinsdetail) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('product_id', ['options' => $products, 'class' => 'form-select select2', 'label' => 'product_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('stockin_id', ['options' => $stockins, 'class' => 'form-select select2', 'label' => 'stockin_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('purchase_price', ['class' => 'form-control', 'label' => 'purchase_price']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('barcode', ['class' => 'form-control', 'label' => 'barcode']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('qty', ['class' => 'form-control', 'label' => 'qty']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('expiry_date', ['empty' => true, 'class' => 'form-control', 'label' => 'expiry_date']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
