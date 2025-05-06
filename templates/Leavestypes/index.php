<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Leavestype> $leavestypes
 */
$this->set('title_2', 'Leavestypes');
$Number = 1;
$this->set('menu_attendances', 'active open');
?>
<div class="mt-3">
    <button class="btn btn-sm btn-primary-light mb-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#NewItem" aria-controls="NewItem"><i class="fa-thin fa-plus"></i> Ajouter</button>
    <?= $this->Html->link(__('Nouveau Leavestype'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100 TableData">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('N°') ?></th>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('maxdaysperyear') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($leavestypes as $leavestype): ?>
                <tr>
                    <td><?= $Number++ ?></td>
                    <td><?= $this->Number->format($leavestype->id) ?></td>
                    <td><?= h($leavestype->name) ?></td>
                    <td><?= $leavestype->maxdaysperyear === null ? '' : $this->Number->format($leavestype->maxdaysperyear) ?></td>
                    <td><?= h($leavestype->created) ?></td>
                    <td><?= h($leavestype->modified) ?></td>
                    <td><?= h($leavestype->createdby) ?></td>
                    <td><?= h($leavestype->modifiedby) ?></td>
                    <td><?= h($leavestype->deleted) ?></td>
                    <td class="text-end">
                        <?= $this->Html->link(__('<i class="ri-eye-line"></i>'), ['action' => 'view', $leavestype->id], ['class' => 'btn btn-success btn-sm', 'escape' => false]) ?>
                        <?= $this->Html->link(__('<i class="ri-pencil-line"></i>'), ['action' => 'edit', $leavestype->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                        <?= $this->Form->postLink(__('<i class="ri-delete-bin-line"></i>'), ['action' => 'delete', $leavestype->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?'), 'escape' => false]) ?>
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
        <h5 class="offcanvas-title" id="offcanvasRightLabel1">Nouveau Leavestypes</h5>
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
                <?= $this->Form->control('maxdaysperyear', ['class' => 'form-control', 'label' => 'maxdaysperyear']); ?>
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
                url: '<?= $this->Url->build(["controller" => 'Leavestypes', 'action' => 'insert']) ?>',
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
