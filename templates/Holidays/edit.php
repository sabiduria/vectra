<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Holiday $holiday
 */
$this->set('title_2', 'Holidays');
$emptyText = "Veuillez selectionner";
$this->set('menu_parameters', 'active open');
?>
<div class="mt-3">
    <?= $this->Form->create($holiday) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('holidaydate', ['empty' => true, 'class' => 'form-control', 'label' => 'holidaydate']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('description', ['class' => 'form-control', 'label' => 'description']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Enregistrer'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
