<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Attendance> $attendances
 */
$this->set('title_2', 'Attendances');
$Number = 1;
$this->set('menu_attendances', 'active open');
?>
<div class="mt-3">
    <button class="btn btn-sm btn-primary-light mb-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#NewItem" aria-controls="NewItem"><i class="fa-thin fa-plus"></i> Ajouter</button>
    <?= $this->Html->link(__('Nouveau Attendance'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100 TableData">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('N°') ?></th>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('affectation_id') ?></th>
                    <th><?= $this->Paginator->sort('attendancestype_id') ?></th>
                    <th><?= $this->Paginator->sort('check_in') ?></th>
                    <th><?= $this->Paginator->sort('check_out') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($attendances as $attendance): ?>
                <tr>
                    <td><?= $Number++ ?></td>
                    <td><?= $this->Number->format($attendance->id) ?></td>
                    <td><?= $attendance->hasValue('affectation') ? $this->Html->link($attendance->affectation->id, ['controller' => 'Affectations', 'action' => 'view', $attendance->affectation->id]) : '' ?></td>
                    <td><?= $attendance->hasValue('attendancestype') ? $this->Html->link($attendance->attendancestype->name, ['controller' => 'Attendancestypes', 'action' => 'view', $attendance->attendancestype->id]) : '' ?></td>
                    <td><?= h($attendance->check_in) ?></td>
                    <td><?= h($attendance->check_out) ?></td>
                    <td><?= h($attendance->created) ?></td>
                    <td><?= h($attendance->modified) ?></td>
                    <td><?= h($attendance->createdby) ?></td>
                    <td><?= h($attendance->modifiedby) ?></td>
                    <td><?= h($attendance->deleted) ?></td>
                    <td class="text-end">
                        <?= $this->Html->link(__('<i class="ri-eye-line"></i>'), ['action' => 'view', $attendance->id], ['class' => 'btn btn-success btn-sm', 'escape' => false]) ?>
                        <?= $this->Html->link(__('<i class="ri-pencil-line"></i>'), ['action' => 'edit', $attendance->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                        <?= $this->Form->postLink(__('<i class="ri-delete-bin-line"></i>'), ['action' => 'delete', $attendance->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?'), 'escape' => false]) ?>
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
        <h5 class="offcanvas-title" id="offcanvasRightLabel1">Nouveau Attendances</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-3">
        <div class="row">
            <div id="response"></div>
<div class="mt-3">
    <?= $this->Form->create(null, ['id' => 'DataForm']);?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('affectation_id', ['options' => $affectations, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'affectation_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('attendancestype_id', ['options' => $attendancestypes, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'attendancestype_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('check_in', ['empty' => true, 'class' => 'form-control', 'label' => 'check_in']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('check_out', ['empty' => true, 'class' => 'form-control', 'label' => 'check_out']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('notes', ['class' => 'form-control', 'label' => 'notes']); ?>
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
                url: '<?= $this->Url->build(["controller" => 'Attendances', 'action' => 'insert']) ?>',
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
