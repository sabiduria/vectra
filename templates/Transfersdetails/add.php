<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Transfersdetail $transfersdetail
 * @var \Cake\Collection\CollectionInterface|string[] $transfers
 * @var \Cake\Collection\CollectionInterface|string[] $products
 */
?>
<div class="mt-3">
    <?= $this->Form->create($transfersdetail) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('transfer_id', ['options' => $transfers, 'class' => 'form-select select2', 'label' => 'transfer_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('product_id', ['options' => $products, 'class' => 'form-select select2', 'label' => 'product_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('qty', ['class' => 'form-control', 'label' => 'qty']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
