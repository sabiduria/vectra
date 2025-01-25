<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Supplier> $suppliers
 */
$this->set('title_2', 'Fournisseurs');
$Number = 1;
?>
<div class="mt-3">
    <button class="btn btn-sm btn-primary-light mb-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#NewItem" aria-controls="NewItem"><i class="fa-thin fa-plus"></i> Ajouter</button>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100 TableData">
            <thead>
            <tr>
                <th><?= $this->Paginator->sort('N°') ?></th>
                <th><?= $this->Paginator->sort('Designation') ?></th>
                <th><?= $this->Paginator->sort('Adresse') ?></th>
                <th><?= $this->Paginator->sort('Tel 1') ?></th>
                <th><?= $this->Paginator->sort('Tel 2') ?></th>
                <th><?= $this->Paginator->sort('Email') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($suppliers as $supplier): ?>
                <tr>
                    <td><?= $Number++ ?></td>
                    <td><?= h($supplier->name) ?></td>
                    <td><?= h($supplier->address) ?></td>
                    <td><?= h($supplier->phone1) ?></td>
                    <td><?= h($supplier->phone2) ?></td>
                    <td><?= h($supplier->email) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Details'), ['action' => 'view', $supplier->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Editer'), ['action' => 'edit', $supplier->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $supplier->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
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
        <h5 class="offcanvas-title" id="offcanvasRightLabel1">Nouveau Suppliers</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-3">
        <div class="row">
            <div id="response"></div>
            <div class="mt-3">
                <?= $this->Form->create(null, ['id' => 'DataForm']);?>
                <div class="row gy-2">
                    <div class="col-xl-12">
                        <?= $this->Form->control('name', ['class' => 'form-control', 'label' => 'Designation']); ?>
                    </div>
                    <div class="col-xl-12">
                        <?= $this->Form->control('address', ['type' => 'textarea', 'class' => 'form-control', 'label' => 'Adresse']); ?>
                    </div>
                    <div class="col-xl-12">
                        <?= $this->Form->control('phone1', ['class' => 'form-control', 'label' => 'Tel 1']); ?>
                    </div>
                    <div class="col-xl-12">
                        <?= $this->Form->control('phone2', ['class' => 'form-control', 'label' => 'Tel 2']); ?>
                    </div>
                    <div class="col-xl-12">
                        <?= $this->Form->control('email', ['class' => 'form-control', 'label' => 'Email']); ?>
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
                url: '<?= $this->Url->build(["controller" => 'Suppliers', 'action' => 'insert']) ?>',
                method: 'POST',
                data: formData,
                dataType: 'json', // Expecting JSON in the response
                success: function(response) {
                    console.log(response.data); // Log the JSON response
                    $('#response').html('<div class="alert alert-success rounded-pill alert-dismissible fade show mb-1 mt-2">' + response.message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="bi bi-x"></i></button> </div>'); // Show success message
                    var newRow = '<tr>';
                    newRow += '<td>'+''+'</td>';
                    newRow += '<td>'+response.data.name+'</td>';
                    newRow += '<td>'+response.data.address+'</td>';
                    newRow += '<td>'+response.data.phone1+'</td>';
                    newRow += '<td>'+response.data.phone2+'</td>';
                    newRow += '<td>'+response.data.email+'</td>';
                    newRow += '<td>'+''+'</td>';
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
