<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Promotionsproduct $promotionsproduct
 * @var string[]|\Cake\Collection\CollectionInterface $products
 */
$this->set('title_2', 'Promotionsproducts');
$emptyText = "Please select";
?>
<div class="mt-3">
    <?= $this->Form->create($promotionsproduct) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('product_id', ['options' => $products, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'product_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('percent', ['class' => 'form-control', 'label' => 'percent']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('startdate', ['empty' => true, 'class' => 'form-control', 'label' => 'startdate']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('enddate', ['empty' => true, 'class' => 'form-control', 'label' => 'enddate']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
