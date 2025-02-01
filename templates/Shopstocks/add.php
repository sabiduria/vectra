<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Shopstock $shopstock
 * @var \Cake\Collection\CollectionInterface|string[] $products
 * @var \Cake\Collection\CollectionInterface|string[] $rooms
 */
$this->set('title_2', 'Shopstocks');
$emptyText = "Veuillez selectionner";
?>
<div class="mt-3">
    <?= $this->Form->create($shopstock) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('product_id', ['options' => $products, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'product_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('room_id', ['options' => $rooms, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'room_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('stock', ['class' => 'form-control', 'label' => 'stock']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('stock_min', ['class' => 'form-control', 'label' => 'stock_min']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('stock_max', ['class' => 'form-control', 'label' => 'stock_max']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Enregistrer'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
