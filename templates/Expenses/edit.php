<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Expense $expense
 * @var string[]|\Cake\Collection\CollectionInterface $shops
 * @var string[]|\Cake\Collection\CollectionInterface $expensestypes
 */
$this->set('title_2', 'Expenses');
$emptyText = "Please select";
?>
<div class="mt-3">
    <?= $this->Form->create($expense) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('shop_id', ['options' => $shops, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'shop_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('expensestype_id', ['options' => $expensestypes, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'expensestype_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('amount', ['class' => 'form-control', 'label' => 'amount']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('description', ['class' => 'form-control', 'label' => 'description']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
