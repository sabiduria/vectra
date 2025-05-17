<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\GeneralParam $generalParam
 */
$this->set('menu_parameters', 'active open');
$this->set('title_2', 'Paramètres Généraux');
$emptyText = "Veuillez selectionner";
?>
<div class="mt-3">
    <?= $this->Form->create($generalParam) ?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('rccm', ['class' => 'form-control', 'label' => 'rccm']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('idnat', ['class' => 'form-control', 'label' => 'idnat']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('impot', ['class' => 'form-control', 'label' => 'impot']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('printer_name', ['class' => 'form-control', 'label' => 'printer_name']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('printer_ip', ['class' => 'form-control', 'label' => 'printer_ip']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('growth', ['class' => 'form-control', 'label' => 'growth']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Enregistrer'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
