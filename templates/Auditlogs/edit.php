<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Auditlog $auditlog
 */
$this->set('title_2', 'Auditlogs');
$emptyText = "Please select";
?>
<div class="mt-3">
    <?= $this->Form->create($auditlog) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('event_type', ['class' => 'form-control', 'label' => 'event_type']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('event_description', ['class' => 'form-control', 'label' => 'event_description']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
