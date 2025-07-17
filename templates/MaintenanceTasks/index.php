<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\MaintenanceTask> $maintenanceTasks
 */
$this->set('title_2', 'Maintenance Tasks');
$Number = 1;
$emptyText = "Veuillez selectionner";
?>
<div class="mt-3">
    <button class="btn btn-sm btn-primary-light mb-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#NewItem" aria-controls="NewItem"><i class="fa-thin fa-plus"></i> Ajouter</button>
    <?= $this->Html->link(__('Nouveau Maintenance Task'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100 TableData">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('N°') ?></th>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('maintenance_record_id') ?></th>
                    <th><?= $this->Paginator->sort('tasks_status') ?></th>
                    <th><?= $this->Paginator->sort('hours_spent') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($maintenanceTasks as $maintenanceTask): ?>
                <tr>
                    <td><?= $Number++ ?></td>
                    <td><?= $this->Number->format($maintenanceTask->id) ?></td>
                    <td><?= $maintenanceTask->hasValue('maintenance_record') ? $this->Html->link($maintenanceTask->maintenance_record->id, ['controller' => 'MaintenanceRecords', 'action' => 'view', $maintenanceTask->maintenance_record->id]) : '' ?></td>
                    <td><?= h($maintenanceTask->tasks_status) ?></td>
                    <td><?= $maintenanceTask->hours_spent === null ? '' : $this->Number->format($maintenanceTask->hours_spent) ?></td>
                    <td><?= h($maintenanceTask->created) ?></td>
                    <td><?= h($maintenanceTask->modified) ?></td>
                    <td><?= h($maintenanceTask->createdby) ?></td>
                    <td><?= h($maintenanceTask->modifiedby) ?></td>
                    <td><?= h($maintenanceTask->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Details'), ['action' => 'view', $maintenanceTask->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Editer'), ['action' => 'edit', $maintenanceTask->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $maintenanceTask->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
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
        <h5 class="offcanvas-title" id="offcanvasRightLabel1">Nouveau Maintenance Tasks</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-3">
        <div class="row">
            <div id="response"></div>
<div class="mt-3">
    <?= $this->Form->create(null, ['id' => 'DataForm']);?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('maintenance_record_id', ['options' => $maintenanceRecords, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'maintenance_record_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('task_description', ['class' => 'form-control', 'label' => 'task_description']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('tasks_status', ['class' => 'form-control', 'label' => 'tasks_status']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('notes', ['class' => 'form-control', 'label' => 'notes']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('hours_spent', ['class' => 'form-control', 'label' => 'hours_spent']); ?>
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
                url: '<?= $this->Url->build(["controller" => 'Maintenance Tasks', 'action' => 'insert']) ?>',
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