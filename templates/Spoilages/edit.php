<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Spoilage $spoilage
 * @var string[]|\Cake\Collection\CollectionInterface $products
 */
$this->set('title_2', 'Spoilages');
$emptyText = "Please select";
?>
<div class="mt-3">
    <?= $this->Form->create($spoilage) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('product_id', ['options' => $products, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'product_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('qty', ['class' => 'form-control', 'label' => 'qty']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('reason', ['class' => 'form-control', 'label' => 'reason']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
