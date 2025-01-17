<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Attendancestype $attendancestype
 */
?>
<div class="mt-3">
    <?= $this->Form->create($attendancestype) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('name', ['class' => 'form-control', 'label' => 'name']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('penality', ['class' => 'form-control', 'label' => 'penality']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
