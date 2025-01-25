<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Paymentstosupplier $paymentstosupplier
 * @var string[]|\Cake\Collection\CollectionInterface $purchases
 */
$this->set('title_2', 'Paymentstosuppliers');
$emptyText = "Veuillez selectionner";
?>
<div class="mt-3">
    <?= $this->Form->create($paymentstosupplier) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('purchase_id', ['options' => $purchases, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'purchase_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('amount', ['class' => 'form-control', 'label' => 'amount']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Enregistrer'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
