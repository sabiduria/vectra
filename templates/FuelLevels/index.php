<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\FuelLevel> $fuelLevels
 */
$this->set('title_2', 'Niveau Carburant');
$Number = 1;
$emptyText = "Veuillez selectionner";
?>
<div class="mt-3">
    <?= $this->Html->link(__('Ajouter'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100 TableData">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('N°') ?></th>
                    <th><?= $this->Paginator->sort('equipment_id') ?></th>
                    <th><?= $this->Paginator->sort('Niveau') ?></th>
                    <th><?= $this->Paginator->sort('Date') ?></th>
                    <th><?= $this->Paginator->sort('Par') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($fuelLevels as $fuelLevel): ?>
                <tr>
                    <td><?= $Number++ ?></td>
                    <td><?= $fuelLevel->hasValue('equipment') ? $this->Html->link($fuelLevel->equipment->name, ['controller' => 'Equipments', 'action' => 'view', $fuelLevel->equipment->id]) : '' ?></td>
                    <td><?= $fuelLevel->current_level === null ? '' : $this->Number->format($fuelLevel->current_level) ?></td>
                    <td><?= h($fuelLevel->created) ?></td>
                    <td><?= h($fuelLevel->createdby) ?></td>
                    <td class="actions">
                        <!--?= $this->Html->link(__('Details'), ['action' => 'view', $fuelLevel->id], ['class' => 'btn btn-success btn-sm']) ?-->
                        <?= $this->Html->link(__('Editer'), ['action' => 'edit', $fuelLevel->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $fuelLevel->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
