<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pricing $pricing
 * @var string[]|\Cake\Collection\CollectionInterface $products
 * @var string[]|\Cake\Collection\CollectionInterface $packagings
 */
$this->set('title_2', 'Pricings');
$emptyText = "Veuillez selectionner";
?>
<div class="mt-3">
    <?= $this->Form->create($pricing) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('product_id', ['options' => $products, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'product_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('packaging_id', ['options' => $packagings, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'packaging_id']); ?>
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
            <?= $this->Form->button(__('Enregistrer'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
