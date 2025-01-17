<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 * @var string[]|\Cake\Collection\CollectionInterface $customers
 * @var string[]|\Cake\Collection\CollectionInterface $statuses
 */
?>
<div class="mt-3">
    <?= $this->Form->create($order) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('customer_id', ['options' => $customers, 'class' => 'form-select select2', 'label' => 'customer_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('status_id', ['options' => $statuses, 'empty' => true, 'class' => 'form-select select2', 'label' => 'status_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('reference', ['class' => 'form-control', 'label' => 'reference']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
