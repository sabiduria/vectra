<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Salesitem $salesitem
 * @var string[]|\Cake\Collection\CollectionInterface $products
 * @var string[]|\Cake\Collection\CollectionInterface $sales
 * @var string[]|\Cake\Collection\CollectionInterface $packagings
 */
?>
<div class="mt-3">
    <?= $this->Form->create($salesitem) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('product_id', ['options' => $products, 'class' => 'form-select select2', 'label' => 'product_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('sale_id', ['options' => $sales, 'class' => 'form-select select2', 'label' => 'sale_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('qty', ['class' => 'form-control', 'label' => 'qty']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('packaging_id', ['options' => $packagings, 'empty' => true, 'class' => 'form-select select2', 'label' => 'packaging_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('unit_price', ['class' => 'form-control', 'label' => 'unit_price']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('subtotal', ['class' => 'form-control', 'label' => 'subtotal']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
