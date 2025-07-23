<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Equipment> $equipments
 */
$this->set('title_2', 'Equipements');
$Number = 1;
$emptyText = "Veuillez selectionner";
?>
<div class="mt-3">
    <?= $this->Html->link(__('Nouvel Equipement'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100 TableData">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('N°') ?></th>
                    <th><?= $this->Paginator->sort('Designation') ?></th>
                    <th><?= $this->Paginator->sort('Etat') ?></th>
                    <th><?= $this->Paginator->sort('Maintenance') ?></th>
                    <th><?= $this->Paginator->sort('Carburant') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($equipments as $equipment): ?>
                <tr>
                    <td><?= $Number++ ?></td>
                    <td>
                        <strong><?= h($equipment->name) ?> <br></strong>
                        <strong>N° Serie :</strong> <?= h($equipment->serial_number) ?> <br>
                        <strong>Modele :</strong> <?= h($equipment->equipment_model) ?> <br>
                        <strong>Fabricant :</strong> <?= h($equipment->manufacturer) ?>
                    </td>
                    <td>
                        <strong>Etat :</strong> <?= h($equipment->equipment_status) ?> <br>
                        <strong>Date Acquisition :</strong> <?= h($equipment->purchase_date) ?> <br>
                        <strong>Expiration Garantie :</strong> <?= h($equipment->warranty_expiration) ?>
                    </td>
                    <td>
                        <strong>Derniere Maintenance :</strong> <?= h($equipment->last_maintenance_date) ?> <br>
                        <strong>Prochaine Maintenace :</strong> <?= h($equipment->next_maintenance_date) ?> <br>
                        <strong>Frequence de Maintenance :</strong> <?= $equipment->maintenance_frequency === null ? '' : $this->Number->format($equipment->maintenance_frequency) ?>
                    </td>
                    <td>
                        <strong>Carburant Max. :</strong><?= $equipment->maximum_fuel === null ? '' : $this->Number->format($equipment->maximum_fuel) ?>
                        <br>
                        <strong>Carburant Min. :</strong> <?= $equipment->minimum_fuel === null ? '' : $this->Number->format($equipment->minimum_fuel) ?>
                    </td>
                    <td class="actions">
                        <?= $this->Html->link(__('Details'), ['action' => 'view', $equipment->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <!--?= $this->Html->link(__('Editer'), ['action' => 'edit', $equipment->id], ['class' => 'btn btn-primary btn-sm']) ?-->
                        <!--?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $equipment->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?-->
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
