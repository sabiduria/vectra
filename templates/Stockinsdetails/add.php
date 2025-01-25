<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Stockinsdetail $stockinsdetail
 * @var \Cake\Collection\CollectionInterface|string[] $products
 * @var \Cake\Collection\CollectionInterface|string[] $stockins
 */
$this->set('title_2', 'Stockinsdetails');
$emptyText = "Veuillez selectionner";
?>
<div class="mt-3">
    <?= $this->Form->create($stockinsdetail) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('product_id', ['options' => $products, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'product_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('stockin_id', ['options' => $stockins, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'stockin_id']); ?>
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
            <?= $this->Form->button(__('Enregistrer'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
