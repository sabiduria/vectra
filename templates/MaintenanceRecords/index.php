<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\MaintenanceRecord> $maintenanceRecords
 */
$this->set('title_2', 'Maintenance Records');
$Number = 1;
$emptyText = "Veuillez selectionner";
?>
<div class="mt-3">
    <button class="btn btn-sm btn-primary-light mb-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#NewItem" aria-controls="NewItem"><i class="fa-thin fa-plus"></i> Ajouter</button>
    <?= $this->Html->link(__('Nouveau Maintenance Record'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100 TableData">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('N°') ?></th>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('maintenance_type') ?></th>
                    <th><?= $this->Paginator->sort('equipment_id') ?></th>
                    <th><?= $this->Paginator->sort('scheduled_date') ?></th>
                    <th><?= $this->Paginator->sort('completion_date') ?></th>
                    <th><?= $this->Paginator->sort('maintenance_status') ?></th>
                    <th><?= $this->Paginator->sort('cost') ?></th>
                    <th><?= $this->Paginator->sort('downtime_hours') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($maintenanceRecords as $maintenanceRecord): ?>
                <tr>
                    <td><?= $Number++ ?></td>
                    <td><?= $this->Number->format($maintenanceRecord->id) ?></td>
                    <td><?= h($maintenanceRecord->maintenance_type) ?></td>
                    <td><?= $maintenanceRecord->hasValue('equipment') ? $this->Html->link($maintenanceRecord->equipment->name, ['controller' => 'Equipments', 'action' => 'view', $maintenanceRecord->equipment->id]) : '' ?></td>
                    <td><?= h($maintenanceRecord->scheduled_date) ?></td>
                    <td><?= h($maintenanceRecord->completion_date) ?></td>
                    <td><?= h($maintenanceRecord->maintenance_status) ?></td>
                    <td><?= $maintenanceRecord->cost === null ? '' : $this->Number->format($maintenanceRecord->cost) ?></td>
                    <td><?= $maintenanceRecord->downtime_hours === null ? '' : $this->Number->format($maintenanceRecord->downtime_hours) ?></td>
                    <td><?= h($maintenanceRecord->created) ?></td>
                    <td><?= h($maintenanceRecord->modified) ?></td>
                    <td><?= h($maintenanceRecord->createdby) ?></td>
                    <td><?= h($maintenanceRecord->modifiedby) ?></td>
                    <td><?= h($maintenanceRecord->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Details'), ['action' => 'view', $maintenanceRecord->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Editer'), ['action' => 'edit', $maintenanceRecord->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $maintenanceRecord->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
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
        <h5 class="offcanvas-title" id="offcanvasRightLabel1">Nouveau Maintenance Records</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-3">
        <div class="row">
            <div id="response"></div>
<div class="mt-3">
    <?= $this->Form->create(null, ['id' => 'DataForm']);?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('maintenance_type', ['class' => 'form-control', 'label' => 'maintenance_type']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('equipment_id', ['options' => $equipments, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'equipment_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('scheduled_date', ['empty' => true, 'class' => 'form-control', 'label' => 'scheduled_date']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('completion_date', ['empty' => true, 'class' => 'form-control', 'label' => 'completion_date']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('maintenance_status', ['class' => 'form-control', 'label' => 'maintenance_status']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('description', ['class' => 'form-control', 'label' => 'description']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('findings', ['class' => 'form-control', 'label' => 'findings']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('recommendations', ['class' => 'form-control', 'label' => 'recommendations']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('cost', ['class' => 'form-control', 'label' => 'cost']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('downtime_hours', ['class' => 'form-control', 'label' => 'downtime_hours']); ?>
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
                url: '<?= $this->Url->build(["controller" => 'Maintenance Records', 'action' => 'insert']) ?>',
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