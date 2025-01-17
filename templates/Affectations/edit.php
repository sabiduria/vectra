<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Affectation $affectation
 * @var string[]|\Cake\Collection\CollectionInterface $users
 * @var string[]|\Cake\Collection\CollectionInterface $profiles
 * @var string[]|\Cake\Collection\CollectionInterface $shops
 */
?>
<div class="mt-3">
    <?= $this->Form->create($affectation) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('user_id', ['options' => $users, 'class' => 'form-select select2', 'label' => 'user_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('profile_id', ['options' => $profiles, 'class' => 'form-select select2', 'label' => 'profile_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('shop_id', ['options' => $shops, 'class' => 'form-select select2', 'label' => 'shop_id']); ?>
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
