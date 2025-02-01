<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Inventory $inventory
 * @var \Cake\Collection\CollectionInterface|string[] $invproducts
 * @var \Cake\Collection\CollectionInterface|string[] $products
 */
$this->set('title_2', 'Inventories');
$emptyText = "Veuillez selectionner";
?>
<div class="mt-3">
    <?= $this->Form->create($inventory) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('invproduct_id', ['options' => $invproducts, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'invproduct_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('product_id', ['options' => $products, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'product_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('qty', ['class' => 'form-control', 'label' => 'qty']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Enregistrer'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
