<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Leavestype $leavestype
 */
$this->set('title_2', 'Leavestypes');
$emptyText = "Veuillez selectionner";
$this->set('menu_attendances', 'active open');
?>
<div class="mt-3">
    <?= $this->Form->create($leavestype) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('name', ['class' => 'form-control', 'label' => 'name']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('maxdaysperyear', ['class' => 'form-control', 'label' => 'maxdaysperyear']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Enregistrer'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
