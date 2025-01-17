<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Shopstock $shopstock
 * @var \Cake\Collection\CollectionInterface|string[] $shops
 * @var \Cake\Collection\CollectionInterface|string[] $products
 * @var \Cake\Collection\CollectionInterface|string[] $rooms
 */
?>
<div class="mt-3">
    <?= $this->Form->create($shopstock) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('shop_id', ['options' => $shops, 'class' => 'form-select select2', 'label' => 'shop_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('product_id', ['options' => $products, 'class' => 'form-select select2', 'label' => 'product_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('room_id', ['options' => $rooms, 'empty' => true, 'class' => 'form-select select2', 'label' => 'room_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('stock', ['class' => 'form-control', 'label' => 'stock']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('stock_min', ['class' => 'form-control', 'label' => 'stock_min']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
