<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Purchase $purchase
 * @var \Cake\Collection\CollectionInterface|string[] $statuses
 * @var \Cake\Collection\CollectionInterface|string[] $suppliers
 */
$this->set('title_2', 'Purchases');
$emptyText = "Veuillez selectionner";
$this->set('menu_purchases', 'active open');
?>
<div class="mt-3">
    <?= $this->Form->create($purchase) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('status_id', ['options' => $statuses, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'status_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('supplier_id', ['options' => $suppliers, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'supplier_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('reference', ['class' => 'form-control', 'label' => 'reference']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('due_date', ['empty' => true, 'class' => 'form-control', 'label' => 'due_date']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('receipt_date', ['empty' => true, 'class' => 'form-control', 'label' => 'receipt_date']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('purchase_group_reference', ['class' => 'form-control', 'label' => 'purchase_group_reference']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Enregistrer'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
