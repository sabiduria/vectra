<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Accessright $accessright
 * @var string[]|\Cake\Collection\CollectionInterface $profiles
 * @var string[]|\Cake\Collection\CollectionInterface $resources
 */
$this->set('title_2', 'Accessrights');
$emptyText = "Veuillez selectionner";
?>
<div class="mt-3">
    <?= $this->Form->create($accessright) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('profile_id', ['options' => $profiles, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'profile_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('resource_id', ['options' => $resources, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'resource_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('c', ['class' => 'form-control', 'label' => 'c']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('r', ['class' => 'form-control', 'label' => 'r']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('u', ['class' => 'form-control', 'label' => 'u']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('d', ['class' => 'form-control', 'label' => 'd']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('p', ['class' => 'form-control', 'label' => 'p']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('v', ['class' => 'form-control', 'label' => 'v']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
