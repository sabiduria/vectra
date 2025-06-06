<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Stockin $stockin
 * @var \Cake\Collection\CollectionInterface|string[] $entrytypes
 * @var \Cake\Collection\CollectionInterface|string[] $shops
 */
$this->set('title_2', 'Stockins');
$emptyText = "Veuillez selectionner";
$this->set('menu_stock', 'active open');
?>
<div class="mt-3">
    <?= $this->Form->create($stockin) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('entrytype_id', ['options' => $entrytypes, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'entrytype_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('shop_id', ['options' => $shops, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'shop_id']); ?>
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
