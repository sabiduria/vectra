<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Exchangerate $exchangerate
 */
$this->set('title_2', 'Exchangerates');
$emptyText = "Veuillez selectionner";
?>
<div class="mt-3">
    <?= $this->Form->create($exchangerate) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('currency_from', ['class' => 'form-control', 'label' => 'currency_from']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('currency_to', ['class' => 'form-control', 'label' => 'currency_to']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('rates', ['class' => 'form-control', 'label' => 'rates']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('isactived', ['class' => 'form-control', 'label' => 'isactived']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
