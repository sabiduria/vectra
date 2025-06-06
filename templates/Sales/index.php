<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Sale> $sales
 */

use App\Controller\GeneralController;

$this->set('title_2', 'Sales');
$Number = 1;
$this->set('menu_sales', 'active open');
?>
<div class="mt-3">
    <?= $this->Html->link(__('<i class="fa-thin fa-plus"></i> Ajouter'), ['action' => 'pos'], ['class' => 'btn btn-sm btn-primary-light mb-3', 'escape' => false]) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100 TableData">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('N°') ?></th>
                    <th><?= $this->Paginator->sort('Ref.') ?></th>
                    <th><?= $this->Paginator->sort('Client') ?></th>
                    <th><?= $this->Paginator->sort('Articles') ?></th>
                    <th><?= $this->Paginator->sort('Quantité') ?></th>
                    <th><?= $this->Paginator->sort('Total') ?></th>
                    <th><?= $this->Paginator->sort('Status') ?></th>
                    <th><?= $this->Paginator->sort('Caissier') ?></th>
                    <th><?= $this->Paginator->sort('Date') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sales as $sale): ?>
                <tr>
                    <td><?= $Number++ ?></td>
                    <td><?= h($sale->reference) ?></td>
                    <td><?= $sale->hasValue('customer') ? $this->Html->link($sale->customer->name, ['controller' => 'Customers', 'action' => 'view', $sale->customer->id]) : '<span class="badge bg-primary3-transparent">Ordinaire</span>' ?></td>
                    <td><?= GeneralController::getSalesItemsNumber($sale->id) ?></td>
                    <td><?= GeneralController::getSalesItemsQuantity($sale->id) ?></td>
                    <td><?= $sale->total_amount === null ? '' : $this->Number->format($sale->total_amount) ?></td>
                    <td><?= $sale->status->name ?></td>
                    <td><?= $sale->hasValue('user') ? $this->Html->link($sale->user->username, ['controller' => 'Users', 'action' => 'view', $sale->user->id]) : '' ?></td>
                    <td><?= h($sale->created) ?></td>
                    <td class="text-end">
                        <?= $this->Html->link(__('<i class="ri-eye-line"></i>'), ['action' => 'view', $sale->id], ['class' => 'btn btn-success btn-sm', 'escape' => false]) ?>
                        <?= $this->Html->link(__('<i class="ri-pencil-line"></i>'), ['action' => 'edit', $sale->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                        <?= $this->Form->postLink(__('<i class="ri-delete-bin-line"></i>'), ['action' => 'delete', $sale->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?'), 'escape' => false]) ?>
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
        <h5 class="offcanvas-title" id="offcanvasRightLabel1">Nouveau Sales</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-3">
        <div class="row">
            <div id="response"></div>
<div class="mt-3">
    <?= $this->Form->create(null, ['id' => 'DataForm']);?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('user_id', ['options' => $users, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'user_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('customer_id', ['options' => $customers, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'customer_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('reference', ['class' => 'form-control', 'label' => 'reference']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('total_amount', ['class' => 'form-control', 'label' => 'total_amount']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('payment_method', ['class' => 'form-control', 'label' => 'payment_method']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('status_id', ['options' => $statuses, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'status_id']); ?>
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
                url: '<?= $this->Url->build(["controller" => 'Sales', 'action' => 'insert']) ?>',
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
