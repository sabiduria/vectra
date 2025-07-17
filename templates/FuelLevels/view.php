<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FuelLevel $fuelLevel
 */
 $this->set('title_2', 'Fuel Levels');
?>
<div class="row">
    <div class="column column-80">
        <div class="fuelLevels view content">
            <h3><?= h($fuelLevel->id) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Equipment') ?></th>
                    <td><?= $fuelLevel->hasValue('equipment') ? $this->Html->link($fuelLevel->equipment->name, ['controller' => 'Equipments', 'action' => 'view', $fuelLevel->equipment->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($fuelLevel->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($fuelLevel->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($fuelLevel->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Current Level') ?></th>
                    <td><?= $fuelLevel->current_level === null ? '' : $this->Number->format($fuelLevel->current_level) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($fuelLevel->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($fuelLevel->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $fuelLevel->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>