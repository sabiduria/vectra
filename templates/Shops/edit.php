<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Shop $shop
 * @var string[]|\Cake\Collection\CollectionInterface $areas
 */
?>
<div class="mt-3">
    <?= $this->Form->create($shop) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('area_id', ['options' => $areas, 'class' => 'form-select select2', 'label' => 'area_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('name', ['class' => 'form-control', 'label' => 'name']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('address', ['class' => 'form-control', 'label' => 'address']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('phone', ['class' => 'form-control', 'label' => 'phone']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
