<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Purchase $purchase
 * @var string[]|\Cake\Collection\CollectionInterface $statuses
 * @var string[]|\Cake\Collection\CollectionInterface $suppliers
 */
$this->set('title_2', 'Purchases');
$emptyText = "Veuillez selectionner";
$this->set('menu_purchases', 'active open');
?>
<div class="mt-3">
    <?= $this->Form->create($purchase) ?>
        <div class="row gy-3">
            <div class="col-xl-12">
                <?= $this->Form->control('supplier_id', ['options' => $suppliers, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'Fournisseur']); ?>
            </div>
            <div class="col-xl-6">
                <?= $this->Form->control('due_date', ['empty' => true, 'class' => 'form-control', 'label' => 'Deadline']); ?>
            </div>
            <div class="col-xl-6">
                <?= $this->Form->control('receipt_date', ['empty' => true, 'class' => 'form-control', 'label' => 'Date de Reception']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Enregistrer'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
