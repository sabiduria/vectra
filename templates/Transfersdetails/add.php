<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Transfersdetail $transfersdetail
 * @var \Cake\Collection\CollectionInterface|string[] $transfers
 * @var \Cake\Collection\CollectionInterface|string[] $products
 */
$this->set('title_2', 'Transfersdetails');
$emptyText = "Veuillez selectionner";
$this->set('menu_stock', 'active open');
?>
<div class="mt-3">
    <?= $this->Form->create($transfersdetail) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('transfer_id', ['options' => $transfers, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'transfer_id']); ?>
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
