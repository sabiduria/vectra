<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ordersitem $ordersitem
 * @var string[]|\Cake\Collection\CollectionInterface $products
 * @var string[]|\Cake\Collection\CollectionInterface $orders
 */
$this->set('title_2', 'Ordersitems');
$emptyText = "Please select";
?>
<div class="mt-3">
    <?= $this->Form->create($ordersitem) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('product_id', ['options' => $products, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'product_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('order_id', ['options' => $orders, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'order_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('qty', ['class' => 'form-control', 'label' => 'qty']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('unit_price', ['class' => 'form-control', 'label' => 'unit_price']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('subtotal', ['class' => 'form-control', 'label' => 'subtotal']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('moodifiedby', ['class' => 'form-control', 'label' => 'moodifiedby']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
