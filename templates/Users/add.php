<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
$this->set('menu_parameters', 'active open');
$this->set('title_2', 'Employés');
$emptyText = "Veuillez selectionner";
$employeeType = ['Intern' => 'Interne', 'Extern' => 'Externe'];
?>
<div class="mt-3">
    <?= $this->Form->create($user) ?>
        <div class="row gy-2">
            <div class="col-xl-6">
                <?= $this->Form->control('firstname', ['class' => 'form-control', 'label' => 'Prenom']); ?>
            </div>
            <div class="col-xl-6">
                <?= $this->Form->control('lastname', ['class' => 'form-control', 'label' => 'Nom & Postnom']); ?>
            </div>
            <div class="col-xl-6">
                <?= $this->Form->control('phone1', ['class' => 'form-control', 'label' => 'Telephone 1']); ?>
            </div>
            <div class="col-xl-6">
                <?= $this->Form->control('phone2', ['class' => 'form-control', 'label' => 'Telephone 2']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('leave_days_month', ['class' => 'form-control', 'label' => 'Quota congés par mois']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('employeetype', ['options' => $employeeType, 'class' => 'form-select', 'label' => 'Type d\'employés']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('address', ['type' => 'textarea', 'class' => 'form-control', 'label' => 'Adresse']); ?>
            </div>
            <div class="col-xl-6">
                <?= $this->Form->control('username', ['class' => 'form-control', 'label' => 'Username']); ?>
            </div>
            <div class="col-xl-6">
                <?= $this->Form->control('password', ['class' => 'form-control', 'label' => 'Mot de Passe']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Enregistrer'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
