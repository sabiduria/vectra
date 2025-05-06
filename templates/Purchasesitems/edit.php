<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Purchasesitem $purchasesitem
 * @var string[]|\Cake\Collection\CollectionInterface $purchases
 * @var string[]|\Cake\Collection\CollectionInterface $products
 */
$this->set('title_2', 'Purchasesitems');
$emptyText = "Veuillez selectionner";
$this->set('menu_purchases', 'active open');
?>
<div class="mt-3">
    <?= $this->Form->create($purchasesitem) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('purchase_id', ['options' => $purchases, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'purchase_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('product_id', ['options' => $products, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'product_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('qty', ['class' => 'form-control', 'label' => 'qty']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('price', ['class' => 'form-control', 'label' => 'price']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Enregistrer'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
