<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MarketProspection $marketProspection
 * @var \Cake\Collection\CollectionInterface|string[] $products
 * @var \Cake\Collection\CollectionInterface|string[] $packagings
 */
$this->set('title_2', 'Market Prospections');
$emptyText = "Veuillez selectionner";
$this->set('menu_prospection', 'active open');
?>
<div class="mt-3">
    <?= $this->Form->create($marketProspection) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('product_id', ['options' => $products, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'product_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('vendor', ['class' => 'form-control', 'label' => 'vendor']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('packaging_id', ['options' => $packagings, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'packaging_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('price', ['class' => 'form-control', 'label' => 'price']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('whole_price', ['class' => 'form-control', 'label' => 'whole_price']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('special_price', ['class' => 'form-control', 'label' => 'special_price']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('comments', ['class' => 'form-control', 'label' => 'comments']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Enregistrer'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
