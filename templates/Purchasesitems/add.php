<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Purchasesitem $purchasesitem
 * @var \Cake\Collection\CollectionInterface|string[] $purchases
 * @var \Cake\Collection\CollectionInterface|string[] $products
 */
?>
<div class="mt-3">
    <?= $this->Form->create($purchasesitem) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('purchase_id', ['options' => $purchases, 'class' => 'form-select select2', 'label' => 'purchase_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('product_id', ['options' => $products, 'class' => 'form-select select2', 'label' => 'product_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('qty', ['class' => 'form-control', 'label' => 'qty']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
