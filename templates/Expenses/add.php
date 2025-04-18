<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Expense $expense
 * @var \Cake\Collection\CollectionInterface|string[] $shops
 * @var \Cake\Collection\CollectionInterface|string[] $expensestypes
 */
$this->set('title_2', 'Depenses');
$emptyText = "Veuillez selectionner";
?>
<div class="mt-3">
    <?= $this->Form->create($expense) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('shop_id', ['options' => $shops, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'Shop']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('expensestype_id', ['options' => $expensestypes, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'Type de depense']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('amount', ['class' => 'form-control', 'label' => 'Montant']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('description', ['class' => 'form-control', 'label' => 'Description']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Enregistrer'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
