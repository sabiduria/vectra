<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Prospection $prospection
 * @var \Cake\Collection\CollectionInterface|string[] $products
 * @var \Cake\Collection\CollectionInterface|string[] $suppliers
 * @var \Cake\Collection\CollectionInterface|string[] $packagings
 */
$this->set('title_2', 'Prospections');
$emptyText = "Veuillez selectionner";
$this->set('menu_prospection', 'active open');
?>
<div class="mt-3">
    <?= $this->Form->create($prospection) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('product_id', ['options' => $products, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'product_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('supplier_id', ['options' => $suppliers, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'supplier_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('packaging_id', ['options' => $packagings, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'packaging_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('price', ['class' => 'form-control', 'label' => 'price']); ?>
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
