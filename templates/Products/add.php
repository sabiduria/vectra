<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 * @var \Cake\Collection\CollectionInterface|string[] $suppliers
 * @var \Cake\Collection\CollectionInterface|string[] $categories
 * @var \Cake\Collection\CollectionInterface|string[] $packagings
 */
$this->set('title_2', 'Products');
$emptyText = "Veuillez selectionner";
?>
<div class="mt-3">
    <?= $this->Form->create($product) ?>
    <div class="row">
        <div class="col-sm-7">
            <div class="row gy-2">
                <div class="col-xl-6">
                    <?= $this->Form->control('supplier_id', ['options' => $suppliers, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'Fournisseurs']); ?>
                </div>
                <div class="col-xl-6">
                    <?= $this->Form->control('category_id', ['options' => $categories, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'Categories']); ?>
                </div>
                <div class="col-xl-12">
                    <?= $this->Form->control('name', ['class' => 'form-control', 'label' => 'Nom']); ?>
                </div>
                <div class="col-xl-6">
                    <?= $this->Form->control('reference', ['class' => 'form-control', 'label' => 'Reference', 'readonly']); ?>
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
                <div class="col-xl-12">
                    <?= $this->Form->control('packaging_id', ['options' => $packagings, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'Packaging par defaut']); ?>
                </div>
                <div class="col-xl-12">
                    <?= $this->Form->control('image', ['type' => 'file', 'class' => 'form-control', 'label' => 'Image']); ?>
                </div>
                <div class="col-xl-6">
                    <?= $this->Form->control('purchase_price', ['type' => 'number', 'class' => 'form-control', 'label' => 'Prix d\'achat']); ?>
                </div>
                <div class="col-xl-6">
                    <?= $this->Form->control('unit_price', ['type' => 'number', 'class' => 'form-control', 'label' => 'Prix de vente']); ?>
                </div>
                <div class="col-xl-6">
                    <?= $this->Form->control('wholesale_price', ['type' => 'number', 'class' => 'form-control', 'label' => 'Prix de gros']); ?>
                </div>
                <div class="col-xl-6">
                    <?= $this->Form->control('special_price', ['type' => 'number', 'class' => 'form-control', 'label' => 'Prix spécial']); ?>
                </div>
                <div class="col-xl-12">
                    <?= $this->Form->control('qty', ['type' => 'number', 'class' => 'form-control', 'label' => 'Stock Initial']); ?>
                </div>
                <div class="col-xl-6">
                    <?= $this->Form->control('stock_min', ['type' => 'number', 'class' => 'form-control', 'label' => 'Stock Minimal']); ?>
                </div>
                <div class="col-xl-6">
                    <?= $this->Form->control('expiry_date', ['type' => 'date', 'class' => 'form-control', 'label' => 'Expiration']); ?>
                </div>
            </div>
        </div>

    </div>
    <div class="mt-3 mb-3">
        <?= $this->Form->button(__('Enregistrer'), ['class'=>'btn btn-success']) ?>
    </div>
    <?= $this->Form->end() ?>
</div>
