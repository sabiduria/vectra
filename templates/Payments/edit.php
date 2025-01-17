<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Payment $payment
 * @var string[]|\Cake\Collection\CollectionInterface $orders
 */
?>
<div class="mt-3">
    <?= $this->Form->create($payment) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('order_id', ['options' => $orders, 'class' => 'form-select select2', 'label' => 'order_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('amount', ['class' => 'form-control', 'label' => 'amount']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
