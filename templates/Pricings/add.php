<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pricing $pricing
 * @var \Cake\Collection\CollectionInterface|string[] $products
 * @var \Cake\Collection\CollectionInterface|string[] $packagings
 */
?>
<div class="mt-3">
    <?= $this->Form->create($pricing) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('product_id', ['options' => $products, 'class' => 'form-select select2', 'label' => 'product_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('packaging_id', ['options' => $packagings, 'class' => 'form-select select2', 'label' => 'packaging_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('unit_price', ['class' => 'form-control', 'label' => 'unit_price']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('wholesale_price', ['class' => 'form-control', 'label' => 'wholesale_price']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('special_price', ['class' => 'form-control', 'label' => 'special_price']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
