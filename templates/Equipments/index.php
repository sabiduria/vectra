<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Equipment> $equipments
 */
$this->set('title_2', 'Equipments');
$Number = 1;
$emptyText = "Veuillez selectionner";
?>
<div class="mt-3">
    <button class="btn btn-sm btn-primary-light mb-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#NewItem" aria-controls="NewItem"><i class="fa-thin fa-plus"></i> Ajouter</button>
    <?= $this->Html->link(__('Nouveau Equipment'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100 TableData">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('N°') ?></th>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('serial_number') ?></th>
                    <th><?= $this->Paginator->sort('equipment_model') ?></th>
                    <th><?= $this->Paginator->sort('manufacturer') ?></th>
                    <th><?= $this->Paginator->sort('purchase_date') ?></th>
                    <th><?= $this->Paginator->sort('warranty_expiration') ?></th>
                    <th><?= $this->Paginator->sort('equipment_status') ?></th>
                    <th><?= $this->Paginator->sort('last_maintenance_date') ?></th>
                    <th><?= $this->Paginator->sort('next_maintenance_date') ?></th>
                    <th><?= $this->Paginator->sort('maintenance_frequency') ?></th>
                    <th><?= $this->Paginator->sort('maximum_fuel') ?></th>
                    <th><?= $this->Paginator->sort('minimum_fuel') ?></th>
                    <th><?= $this->Paginator->sort('tracked_fuel') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($equipments as $equipment): ?>
                <tr>
                    <td><?= $Number++ ?></td>
                    <td><?= $this->Number->format($equipment->id) ?></td>
                    <td><?= h($equipment->name) ?></td>
                    <td><?= h($equipment->serial_number) ?></td>
                    <td><?= h($equipment->equipment_model) ?></td>
                    <td><?= h($equipment->manufacturer) ?></td>
                    <td><?= h($equipment->purchase_date) ?></td>
                    <td><?= h($equipment->warranty_expiration) ?></td>
                    <td><?= h($equipment->equipment_status) ?></td>
                    <td><?= h($equipment->last_maintenance_date) ?></td>
                    <td><?= h($equipment->next_maintenance_date) ?></td>
                    <td><?= $equipment->maintenance_frequency === null ? '' : $this->Number->format($equipment->maintenance_frequency) ?></td>
                    <td><?= $equipment->maximum_fuel === null ? '' : $this->Number->format($equipment->maximum_fuel) ?></td>
                    <td><?= $equipment->minimum_fuel === null ? '' : $this->Number->format($equipment->minimum_fuel) ?></td>
                    <td><?= h($equipment->tracked_fuel) ?></td>
                    <td><?= h($equipment->created) ?></td>
                    <td><?= h($equipment->modified) ?></td>
                    <td><?= h($equipment->createdby) ?></td>
                    <td><?= h($equipment->modifiedby) ?></td>
                    <td><?= h($equipment->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Details'), ['action' => 'view', $equipment->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Editer'), ['action' => 'edit', $equipment->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $equipment->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="NewItem"
     aria-labelledby="offcanvasRightLabel1">
    <div class="offcanvas-header border-bottom border-block-end-dashed">
        <h5 class="offcanvas-title" id="offcanvasRightLabel1">Nouveau Equipments</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-3">
        <div class="row">
            <div id="response"></div>
<div class="mt-3">
    <?= $this->Form->create(null, ['id' => 'DataForm']);?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('name', ['class' => 'form-control', 'label' => 'name']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('serial_number', ['class' => 'form-control', 'label' => 'serial_number']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('equipment_model', ['class' => 'form-control', 'label' => 'equipment_model']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('manufacturer', ['class' => 'form-control', 'label' => 'manufacturer']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('purchase_date', ['empty' => true, 'class' => 'form-control', 'label' => 'purchase_date']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('warranty_expiration', ['empty' => true, 'class' => 'form-control', 'label' => 'warranty_expiration']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('equipment_status', ['class' => 'form-control', 'label' => 'equipment_status']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('last_maintenance_date', ['empty' => true, 'class' => 'form-control', 'label' => 'last_maintenance_date']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('next_maintenance_date', ['empty' => true, 'class' => 'form-control', 'label' => 'next_maintenance_date']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('maintenance_frequency', ['class' => 'form-control', 'label' => 'maintenance_frequency']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('maximum_fuel', ['class' => 'form-control', 'label' => 'maximum_fuel']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('minimum_fuel', ['class' => 'form-control', 'label' => 'minimum_fuel']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('tracked_fuel', ['class' => 'form-control', 'label' => 'tracked_fuel']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Enregistrer'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#DataForm').on('submit', function(e) {
            e.preventDefault(); // Prevent default form submission
            // Get form data
            var formData = $(this).serialize();

            // Perform AJAX request
            $.ajax({
                url: '<?= $this->Url->build(["controller" => 'Equipments', 'action' => 'insert']) ?>',
                method: 'POST',
                data: formData,
                dataType: 'json', // Expecting JSON in the response
                success: function(response) {
                    console.log(response.data); // Log the JSON response
                    $('#response').html('<div class="alert alert-success rounded-pill alert-dismissible fade show mb-1 mt-2">' + response.message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="bi bi-x"></i></button> </div>'); // Show success message
                    var newRow = '<tr>';
                    newRow += '<td>'+''+'</td>'; // Add your actions
                    newRow += '</tr>';

                    // Append the new row to the table
                    $('.TableData tbody').append(newRow);
                    $('#DataForm')[0].reset();
                },
                error: function(xhr, status, error) {
                    console.error(error); // Log any error
                    $('#response').html('<p>An error occurred. Please try again.</p>');
                }
            });
        });
    });
</script>