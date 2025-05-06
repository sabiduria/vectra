<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Room $room
 * @var string[]|\Cake\Collection\CollectionInterface $shops
 */
$this->set('title_2', 'Locaux');
$emptyText = "Veuillez selectionner";
$this->set('menu_warehouse', 'active open');
?>
<div class="mt-3">
    <?= $this->Form->create($room) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('name', ['class' => 'form-control', 'label' => 'Designation']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('capacity', ['class' => 'form-control', 'label' => 'Capacité']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('shops_id', ['options' => $shops, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'Shops']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Enregistrer'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
