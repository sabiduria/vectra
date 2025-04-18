<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Spent $spent
 * @var string[]|\Cake\Collection\CollectionInterface $purchases
 * @var string[]|\Cake\Collection\CollectionInterface $spenttypes
 */
$this->set('title_2', 'Spents');
$emptyText = "Veuillez selectionner";
?>
<div class="mt-3">
    <?= $this->Form->create($spent) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('purchase_id', ['options' => $purchases, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'purchase_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('spenttype_id', ['options' => $spenttypes, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'spenttype_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('description', ['class' => 'form-control', 'label' => 'description']); ?>
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
