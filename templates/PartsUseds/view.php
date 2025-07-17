<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PartsUsed $partsUsed
 */
 $this->set('title_2', 'Parts Useds');
?>
<div class="row">
    <div class="column column-80">
        <div class="partsUseds view content">
            <h3><?= h($partsUsed->name) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Maintenance Record') ?></th>
                    <td><?= $partsUsed->hasValue('maintenance_record') ? $this->Html->link($partsUsed->maintenance_record->id, ['controller' => 'MaintenanceRecords', 'action' => 'view', $partsUsed->maintenance_record->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($partsUsed->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($partsUsed->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($partsUsed->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($partsUsed->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Quantity') ?></th>
                    <td><?= $partsUsed->quantity === null ? '' : $this->Number->format($partsUsed->quantity) ?></td>
                </tr>
                <tr>
                    <th><?= __('Unit Cost') ?></th>
                    <td><?= $partsUsed->unit_cost === null ? '' : $this->Number->format($partsUsed->unit_cost) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($partsUsed->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($partsUsed->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $partsUsed->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>