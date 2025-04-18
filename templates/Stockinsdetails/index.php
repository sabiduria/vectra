<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Stockinsdetail> $stockinsdetails
 */
$this->set('title_2', 'Stockinsdetails');
$Number = 1;
?>
<div class="mt-3">
    <button class="btn btn-sm btn-primary-light mb-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#NewItem" aria-controls="NewItem"><i class="fa-thin fa-plus"></i> Ajouter</button>
    <?= $this->Html->link(__('Nouveau Stockinsdetail'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100 TableData">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('N°') ?></th>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('product_id') ?></th>
                    <th><?= $this->Paginator->sort('stockin_id') ?></th>
                    <th><?= $this->Paginator->sort('room_id') ?></th>
                    <th><?= $this->Paginator->sort('purchase_price') ?></th>
                    <th><?= $this->Paginator->sort('tax') ?></th>
                    <th><?= $this->Paginator->sort('barcode') ?></th>
                    <th><?= $this->Paginator->sort('qty') ?></th>
                    <th><?= $this->Paginator->sort('expiry_date') ?></th>
                    <th><?= $this->Paginator->sort('entry_state') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($stockinsdetails as $stockinsdetail): ?>
                <tr>
                    <td><?= $Number++ ?></td>
                    <td><?= $this->Number->format($stockinsdetail->id) ?></td>
                    <td><?= $stockinsdetail->hasValue('product') ? $this->Html->link($stockinsdetail->product->name, ['controller' => 'Products', 'action' => 'view', $stockinsdetail->product->id]) : '' ?></td>
                    <td><?= $stockinsdetail->hasValue('stockin') ? $this->Html->link($stockinsdetail->stockin->id, ['controller' => 'Stockins', 'action' => 'view', $stockinsdetail->stockin->id]) : '' ?></td>
                    <td><?= $stockinsdetail->hasValue('room') ? $this->Html->link($stockinsdetail->room->name, ['controller' => 'Rooms', 'action' => 'view', $stockinsdetail->room->id]) : '' ?></td>
                    <td><?= $stockinsdetail->purchase_price === null ? '' : $this->Number->format($stockinsdetail->purchase_price) ?></td>
                    <td><?= $stockinsdetail->tax === null ? '' : $this->Number->format($stockinsdetail->tax) ?></td>
                    <td><?= h($stockinsdetail->barcode) ?></td>
                    <td><?= $stockinsdetail->qty === null ? '' : $this->Number->format($stockinsdetail->qty) ?></td>
                    <td><?= h($stockinsdetail->expiry_date) ?></td>
                    <td><?= $stockinsdetail->entry_state === null ? '' : $this->Number->format($stockinsdetail->entry_state) ?></td>
                    <td><?= h($stockinsdetail->created) ?></td>
                    <td><?= h($stockinsdetail->modified) ?></td>
                    <td><?= h($stockinsdetail->createdby) ?></td>
                    <td><?= h($stockinsdetail->modifiedby) ?></td>
                    <td><?= h($stockinsdetail->deleted) ?></td>
                    <td class="text-end">
                        <?= $this->Html->link(__('<i class="ri-eye-line"></i>'), ['action' => 'view', $stockinsdetail->id], ['class' => 'btn btn-success btn-sm', 'escape' => false]) ?>
                        <?= $this->Html->link(__('<i class="ri-pencil-line"></i>'), ['action' => 'edit', $stockinsdetail->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                        <?= $this->Form->postLink(__('<i class="ri-delete-bin-line"></i>'), ['action' => 'delete', $stockinsdetail->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?'), 'escape' => false]) ?>
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
        <h5 class="offcanvas-title" id="offcanvasRightLabel1">Nouveau Stockinsdetails</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-3">
        <div class="row">
            <div id="response"></div>
<div class="mt-3">
    <?= $this->Form->create(null, ['id' => 'DataForm']);?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('product_id', ['options' => $products, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'product_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('stockin_id', ['options' => $stockins, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'stockin_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('room_id', ['options' => $rooms, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'room_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('purchase_price', ['class' => 'form-control', 'label' => 'purchase_price']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('tax', ['class' => 'form-control', 'label' => 'tax']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('barcode', ['class' => 'form-control', 'label' => 'barcode']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('qty', ['class' => 'form-control', 'label' => 'qty']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('expiry_date', ['empty' => true, 'class' => 'form-control', 'label' => 'expiry_date']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('entry_state', ['class' => 'form-control', 'label' => 'entry_state']); ?>
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
                url: '<?= $this->Url->build(["controller" => 'Stockinsdetails', 'action' => 'insert']) ?>',
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
