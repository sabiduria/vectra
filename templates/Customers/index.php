<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Customer> $customers
 */
$this->set('title_2', 'Clients');
$Number = 1;
?>
<div class="mt-3">
    <button class="btn btn-sm btn-primary-light mb-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#NewItem" aria-controls="NewItem"><i class="fa-thin fa-plus"></i> Ajouter</button>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100 TableData">
            <thead>
            <tr>
                <th><?= $this->Paginator->sort('N°') ?></th>
                <th><?= $this->Paginator->sort('Nom') ?></th>
                <th><?= $this->Paginator->sort('Telephome') ?></th>
                <th><?= $this->Paginator->sort('Username') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?= $Number++ ?></td>
                    <td><?= h($customer->name) ?></td>
                    <td><?= h($customer->phone) ?></td>
                    <td><?= h($customer->username) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Details'), ['action' => 'view', $customer->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Editer'), ['action' => 'edit', $customer->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $customer->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
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
        <h5 class="offcanvas-title" id="offcanvasRightLabel1">Nouveau Client</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-3">
        <div class="row">
            <div id="response"></div>
            <div class="mt-3">
                <?= $this->Form->create(null, ['id' => 'DataForm']);?>
                <div class="row gy-2">
                    <div class="col-xl-12">
                        <?= $this->Form->control('name', ['class' => 'form-control', 'label' => 'Nom']); ?>
                    </div>
                    <div class="col-xl-12">
                        <?= $this->Form->control('phone', ['class' => 'form-control', 'label' => 'Telephone']); ?>
                    </div>
                    <div class="col-xl-12">
                        <?= $this->Form->control('username', ['class' => 'form-control', 'label' => 'Username']); ?>
                    </div>
                    <div class="col-xl-12">
                        <?= $this->Form->control('password', ['class' => 'form-control', 'label' => 'Mot de passe']); ?>
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
                url: '<?= $this->Url->build(["controller" => 'Customers', 'action' => 'insert']) ?>',
                method: 'POST',
                data: formData,
                dataType: 'json', // Expecting JSON in the response
                success: function(response) {
                    console.log(response.data); // Log the JSON response
                    $('#response').html('<div class="alert alert-success rounded-pill alert-dismissible fade show mb-1 mt-2">' + response.message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="bi bi-x"></i></button> </div>'); // Show success message
                    var newRow = '<tr>';
                    newRow += '<td>'+''+'</td>';
                    newRow += '<td>'+response.data.name+'</td>';
                    newRow += '<td>'+response.data.phone+'</td>';
                    newRow += '<td>'+response.data.username+'</td>';
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
