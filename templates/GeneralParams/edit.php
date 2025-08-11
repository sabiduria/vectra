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
                <?= $this->Form->control('business_name', ['class' => 'form-control', 'label' => 'Denomination Sociale']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('rccm', ['class' => 'form-control', 'label' => 'RCCM']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('idnat', ['class' => 'form-control', 'label' => 'ID NAT']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('impot', ['class' => 'form-control', 'label' => 'IMPOT']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('printer_name', ['class' => 'form-control', 'label' => 'NOM DE L\'IMPRIMANTE']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('printer_ip', ['class' => 'form-control', 'label' => 'IP DE L\'IMPRIMANTE']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('growth', ['class' => 'form-control', 'label' => 'TAUX DE CROISSANCE']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Enregistrer'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
