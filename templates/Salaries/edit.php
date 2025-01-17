<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Salary $salary
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
$this->set('title_2', 'Salaries');
$emptyText = "Please select";
?>
<div class="mt-3">
    <?= $this->Form->create($salary) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('user_id', ['options' => $users, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'user_id']); ?>
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
