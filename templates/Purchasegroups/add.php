<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Purchasegroup $purchasegroup
 */
$this->set('title_2', 'Purchasegroups');
$emptyText = "Veuillez selectionner";
$this->set('menu_purchases', 'active open');
?>
<div class="mt-3">
    <?= $this->Form->create($purchasegroup) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('shop_id', ['class' => 'form-control', 'label' => 'shop_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('reference', ['class' => 'form-control', 'label' => 'reference']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Enregistrer'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
