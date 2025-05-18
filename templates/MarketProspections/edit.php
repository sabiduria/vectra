<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MarketProspection $marketProspection
 * @var string[]|\Cake\Collection\CollectionInterface $products
 * @var string[]|\Cake\Collection\CollectionInterface $packagings
 */
$this->set('title_2', 'Market Prospections');
$emptyText = "Veuillez selectionner";
$this->set('menu_prospection', 'active open');
?>
<div class="mt-3">
    <?= $this->Form->create($marketProspection) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('product_id', ['options' => $products, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'Articles']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('vendor', ['class' => 'form-control', 'label' => 'Marchant']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('packaging_id', ['options' => $packagings, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'Packaging']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('price', ['class' => 'form-control', 'label' => 'Prix Unitaire']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('whole_price', ['class' => 'form-control', 'label' => 'Prix de gros']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('special_price', ['class' => 'form-control', 'label' => 'Prix Special']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('comments', ['class' => 'form-control', 'label' => 'Commentaires']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Enregistrer'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
