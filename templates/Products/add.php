<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 * @var \Cake\Collection\CollectionInterface|string[] $suppliers
 * @var \Cake\Collection\CollectionInterface|string[] $categories
 * @var \Cake\Collection\CollectionInterface|string[] $packagings
 */
$this->set('title_2', 'Articles');
$emptyText = "Veuillez selectionner";
?>
<div class="mt-3">
    <?= $this->Form->create($product, ['type' => 'file']) ?>
    <div class="row">
        <div class="col-sm-7">
            <div class="row gy-2">
                <h6>Information sur le Produit</h6>
                <div class="col-xl-12">
                    <?= $this->Form->control('image', ['type' => 'file', 'class' => 'form-control', 'label' => 'Image']); ?>
                </div>
                <div class="col-xl-12">
                    <?= $this->Form->control('name', ['class' => 'form-control', 'label' => 'Designation']); ?>
                </div>
                <div class="col-xl-4">
                    <?= $this->Form->control('supplier_id', ['options' => $suppliers, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'Fournisseur Preféré']); ?>
                </div>
                <div class="col-xl-4">
                    <?= $this->Form->control('category_id', ['options' => $categories, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'Categorie']); ?>
                </div>
                <div class="col-xl-4">
                    <?= $this->Form->control('packaging_id', ['options' => $packagings, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'Package par defaut']); ?>
                </div>
                <div class="col-xl-6">
                    <?= $this->Form->control('reference', ['class' => 'form-control', 'label' => 'Reference']); ?>
                </div>
                <div class="col-xl-6">
                    <?= $this->Form->control('barcode', ['class' => 'form-control', 'label' => 'Barcode']); ?>
                </div>
                <div class="col-xl-6">
                    <?= $this->Form->control('specifications', ['class' => 'form-control', 'label' => 'Specifications']); ?>
                </div>
                <div class="col-xl-6">
                    <?= $this->Form->control('notes', ['class' => 'form-control', 'label' => 'Notes']); ?>
                </div>
            </div>
        </div>
        <div class="col-sm-5">
            <div class="row gy-2">
                <h6>Information sur le Stock</h6>
                <div class="col-xl-12">
                    <?= $this->Form->control('stock', ['type' => 'number', 'min' => '0', 'step' => '0.1', 'class' => 'form-control', 'label' => 'Stock Initial']); ?>
                </div>
                <div class="col-xl-6">
                    <?= $this->Form->control('stock_min', ['type' => 'number', 'min' => '0', 'step' => '0.1', 'class' => 'form-control', 'label' => 'Stock Minimum']); ?>
                </div>
                <div class="col-xl-6">
                    <?= $this->Form->control('stock_max', ['type' => 'number', 'min' => '0', 'step' => '0.1', 'class' => 'form-control', 'label' => 'Stock Maximum']); ?>
                </div>
                <div class="col-xl-12">
                    <?= $this->Form->control('room_id', ['options' => $packagings, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'Lieu de conservation']); ?>
                </div>
            </div>
        </div>
    </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Enregistrer'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
