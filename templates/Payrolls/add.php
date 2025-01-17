<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Payroll $payroll
 * @var \Cake\Collection\CollectionInterface|string[] $salaries
 */
?>
<div class="mt-3">
    <?= $this->Form->create($payroll) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('salary_id', ['options' => $salaries, 'class' => 'form-select select2', 'label' => 'salary_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('period_start', ['empty' => true, 'class' => 'form-control', 'label' => 'period_start']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('period_end', ['empty' => true, 'class' => 'form-control', 'label' => 'period_end']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('period_salary', ['class' => 'form-control', 'label' => 'period_salary']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('salary_payed', ['class' => 'form-control', 'label' => 'salary_payed']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('deductions', ['class' => 'form-control', 'label' => 'deductions']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('bonus', ['class' => 'form-control', 'label' => 'bonus']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('totally_payed', ['class' => 'form-control', 'label' => 'totally_payed']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
