<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Stockinsdetail $stockinsdetail
 * @var string[]|\Cake\Collection\CollectionInterface $products
 * @var string[]|\Cake\Collection\CollectionInterface $stockins
 * @var string[]|\Cake\Collection\CollectionInterface $rooms
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
                <?= $this->Form->control('room_id', ['options' => $rooms, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'room_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('purchase_price', ['class' => 'form-control', 'label' => 'purchase_price']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('tax', ['class' => 'form-control', 'label' => 'tax']); ?>
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
            <div class="col-xl-12">
                <?= $this->Form->control('entry_state', ['class' => 'form-control', 'label' => 'entry_state']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Enregistrer'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
