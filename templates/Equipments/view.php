<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Equipment $equipment
 */
 $this->set('title_2', 'Equipments');
?>
<div class="row">
    <div class="column column-80">
        <div class="equipments view content">
            <h3><?= h($equipment->name) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($equipment->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Serial Number') ?></th>
                    <td><?= h($equipment->serial_number) ?></td>
                </tr>
                <tr>
                    <th><?= __('Equipment Model') ?></th>
                    <td><?= h($equipment->equipment_model) ?></td>
                </tr>
                <tr>
                    <th><?= __('Manufacturer') ?></th>
                    <td><?= h($equipment->manufacturer) ?></td>
                </tr>
                <tr>
                    <th><?= __('Equipment Status') ?></th>
                    <td><?= h($equipment->equipment_status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($equipment->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($equipment->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($equipment->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Maintenance Frequency') ?></th>
                    <td><?= $equipment->maintenance_frequency === null ? '' : $this->Number->format($equipment->maintenance_frequency) ?></td>
                </tr>
                <tr>
                    <th><?= __('Maximum Fuel') ?></th>
                    <td><?= $equipment->maximum_fuel === null ? '' : $this->Number->format($equipment->maximum_fuel) ?></td>
                </tr>
                <tr>
                    <th><?= __('Purchase Date') ?></th>
                    <td><?= h($equipment->purchase_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Warranty Expiration') ?></th>
                    <td><?= h($equipment->warranty_expiration) ?></td>
                </tr>
                <tr>
                    <th><?= __('Last Maintenance Date') ?></th>
                    <td><?= h($equipment->last_maintenance_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Next Maintenance Date') ?></th>
                    <td><?= h($equipment->next_maintenance_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($equipment->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($equipment->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tracked Fuel') ?></th>
                    <td><?= $equipment->tracked_fuel ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $equipment->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Fuel Levels') ?></h4>
                <?php if (!empty($equipment->fuel_levels)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Equipment Id') ?></th>
                            <th><?= __('Current Level') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($equipment->fuel_levels as $fuelLevel) : ?>
                        <tr>
                            <td><?= h($fuelLevel->id) ?></td>
                            <td><?= h($fuelLevel->equipment_id) ?></td>
                            <td><?= h($fuelLevel->current_level) ?></td>
                            <td><?= h($fuelLevel->created) ?></td>
                            <td><?= h($fuelLevel->modified) ?></td>
                            <td><?= h($fuelLevel->createdby) ?></td>
                            <td><?= h($fuelLevel->modifiedby) ?></td>
                            <td><?= h($fuelLevel->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('Details'), ['controller' => 'FuelLevels', 'action' => 'view', $fuelLevel->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Editer'), ['controller' => 'FuelLevels', 'action' => 'edit', $fuelLevel->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'FuelLevels', 'action' => 'delete', $fuelLevel->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Maintenance Records') ?></h4>
                <?php if (!empty($equipment->maintenance_records)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Maintenance Type') ?></th>
                            <th><?= __('Equipment Id') ?></th>
                            <th><?= __('Scheduled Date') ?></th>
                            <th><?= __('Completion Date') ?></th>
                            <th><?= __('Maintenance Status') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Findings') ?></th>
                            <th><?= __('Recommendations') ?></th>
                            <th><?= __('Cost') ?></th>
                            <th><?= __('Downtime Hours') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($equipment->maintenance_records as $maintenanceRecord) : ?>
                        <tr>
                            <td><?= h($maintenanceRecord->id) ?></td>
                            <td><?= h($maintenanceRecord->maintenance_type) ?></td>
                            <td><?= h($maintenanceRecord->equipment_id) ?></td>
                            <td><?= h($maintenanceRecord->scheduled_date) ?></td>
                            <td><?= h($maintenanceRecord->completion_date) ?></td>
                            <td><?= h($maintenanceRecord->maintenance_status) ?></td>
                            <td><?= h($maintenanceRecord->description) ?></td>
                            <td><?= h($maintenanceRecord->findings) ?></td>
                            <td><?= h($maintenanceRecord->recommendations) ?></td>
                            <td><?= h($maintenanceRecord->cost) ?></td>
                            <td><?= h($maintenanceRecord->downtime_hours) ?></td>
                            <td><?= h($maintenanceRecord->created) ?></td>
                            <td><?= h($maintenanceRecord->modified) ?></td>
                            <td><?= h($maintenanceRecord->createdby) ?></td>
                            <td><?= h($maintenanceRecord->modifiedby) ?></td>
                            <td><?= h($maintenanceRecord->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('Details'), ['controller' => 'MaintenanceRecords', 'action' => 'view', $maintenanceRecord->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Editer'), ['controller' => 'MaintenanceRecords', 'action' => 'edit', $maintenanceRecord->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'MaintenanceRecords', 'action' => 'delete', $maintenanceRecord->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>