<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 * @var \Cake\Collection\CollectionInterface|string[] $suppliers
 * @var \Cake\Collection\CollectionInterface|string[] $categories
 * @var \Cake\Collection\CollectionInterface|string[] $packagings
 */
?>
<div class="mt-3">
    <?= $this->Form->create($product) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('supplier_id', ['options' => $suppliers, 'class' => 'form-select select2', 'label' => 'supplier_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('category_id', ['options' => $categories, 'class' => 'form-select select2', 'label' => 'category_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('reference', ['class' => 'form-control', 'label' => 'reference']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('barcode', ['class' => 'form-control', 'label' => 'barcode']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('name', ['class' => 'form-control', 'label' => 'name']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('specifications', ['class' => 'form-control', 'label' => 'specifications']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('notes', ['class' => 'form-control', 'label' => 'notes']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('packaging_id', ['options' => $packagings, 'empty' => true, 'class' => 'form-select select2', 'label' => 'packaging_id']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
