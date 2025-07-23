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
            <div class="row">
                <div class="col-sm-8">
                    <h3><?= h($equipment->name) ?></h3>
                </div>
                <div class="col-sm-4">
                    <table class="table">
                        <tr>
                            <th><?= __('Derniere date Maintenance') ?></th>
                            <td><?= h($equipment->last_maintenance_date) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Prochaine date Maintenance') ?></th>
                            <td><?= h($equipment->next_maintenance_date) ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-sm-6">
                    <table class="table">
                        <tr>
                            <th><?= __('N° Serie') ?></th>
                            <td><?= h($equipment->serial_number) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Modele') ?></th>
                            <td><?= h($equipment->equipment_model) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Fabricant') ?></th>
                            <td><?= h($equipment->manufacturer) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Status') ?></th>
                            <td><?= h($equipment->equipment_status) ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-sm-6">
                    <table class="table">
                        <tr>
                            <th><?= __('Maximum Carburant') ?></th>
                            <td><?= $equipment->maximum_fuel === null ? '' : $this->Number->format($equipment->maximum_fuel) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Minimum Carburant') ?></th>
                            <td><?= $equipment->minimum_fuel === null ? '' : $this->Number->format($equipment->minimum_fuel) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Date Acquisition') ?></th>
                            <td><?= h($equipment->purchase_date) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Expiration Garantie') ?></th>
                            <td><?= h($equipment->warranty_expiration) ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <hr>

            <div class="related">
                <h4><?= __('Historique Niveau Carburant') ?></h4>
                <?php if (!empty($equipment->fuel_levels)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Niveau') ?></th>
                            <th><?= __('Date') ?></th>
                            <th><?= __('Date Modification') ?></th>
                            <th><?= __('Par') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($equipment->fuel_levels as $fuelLevel) : ?>
                        <tr>
                            <td><?= h($fuelLevel->id) ?></td>
                            <td><?= h($fuelLevel->current_level) ?></td>
                            <td><?= h($fuelLevel->created) ?></td>
                            <td><?= h($fuelLevel->modified) ?></td>
                            <td><?= h($fuelLevel->modifiedby) ?></td>
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
                <h4><?= __('Historique des Maintenances') ?></h4>
                <?php if (!empty($equipment->maintenance_records)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Type') ?></th>
                            <th><?= __('Date Programmee') ?></th>
                            <th><?= __('Date Execution') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Cout') ?></th>
                            <th><?= __('Date') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($equipment->maintenance_records as $maintenanceRecord) : ?>
                        <tr>
                            <td><?= h($maintenanceRecord->id) ?></td>
                            <td><?= h($maintenanceRecord->maintenance_type) ?></td>
                            <td><?= h($maintenanceRecord->scheduled_date) ?></td>
                            <td><?= h($maintenanceRecord->completion_date) ?></td>
                            <td><?= h($maintenanceRecord->maintenance_status) ?></td>
                            <td><?= h($maintenanceRecord->cost) ?></td>
                            <td><?= h($maintenanceRecord->created) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('Details'), ['controller' => 'MaintenanceRecords', 'action' => 'view', $maintenanceRecord->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <!--?= $this->Html->link(__('Editer'), ['controller' => 'MaintenanceRecords', 'action' => 'edit', $maintenanceRecord->id], ['class' => 'btn btn-primary btn-sm']) ?-->
                                <!--?= $this->Form->postLink(__('Supprimer'), ['controller' => 'MaintenanceRecords', 'action' => 'delete', $maintenanceRecord->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?-->
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
