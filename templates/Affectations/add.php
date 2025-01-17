<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Affectation $affectation
 * @var \Cake\Collection\CollectionInterface|string[] $users
 * @var \Cake\Collection\CollectionInterface|string[] $profiles
 * @var \Cake\Collection\CollectionInterface|string[] $shops
 */
$this->set('title_2', 'Affectations');
$emptyText = "Please select";
?>
<div class="mt-3">
    <?= $this->Form->create($affectation) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('user_id', ['options' => $users, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'user_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('profile_id', ['options' => $profiles, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'profile_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('shop_id', ['options' => $shops, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'shop_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('isactived', ['class' => 'form-control', 'label' => 'isactived']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
