<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 * @var string[]|\Cake\Collection\CollectionInterface $customers
 * @var string[]|\Cake\Collection\CollectionInterface $statuses
 */
$this->set('title_2', 'Orders');
$emptyText = "Veuillez selectionner";
$this->set('menu_orders', 'active open');
?>
<div class="mt-3">
    <?= $this->Form->create($order) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('customer_id', ['options' => $customers, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'customer_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('status_id', ['options' => $statuses, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'status_id']); ?>
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
