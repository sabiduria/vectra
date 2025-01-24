<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Expensestype $expensestype
 */
$this->set('title_2', 'Expensestypes');
$emptyText = "Veuillez selectionner";
?>
<div class="mt-3">
    <?= $this->Form->create($expensestype) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('name', ['class' => 'form-control', 'label' => 'name']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('description', ['class' => 'form-control', 'label' => 'description']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('monthy_amount', ['class' => 'form-control', 'label' => 'monthy_amount']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
