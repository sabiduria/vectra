<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Shopstock> $shopstocks
 */
$this->set('title_2', 'Shopstocks');
$Number = 1;
?>
<div class="mt-3">
    <button class="btn btn-sm btn-primary-light mb-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#NewItem" aria-controls="NewItem"><i class="fa-thin fa-plus"></i> Ajouter</button>
    <?= $this->Html->link(__('Nouveau Shopstock'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100 TableData">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('N°') ?></th>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('product_id') ?></th>
                    <th><?= $this->Paginator->sort('room_id') ?></th>
                    <th><?= $this->Paginator->sort('stock') ?></th>
                    <th><?= $this->Paginator->sort('stock_min') ?></th>
                    <th><?= $this->Paginator->sort('stock_max') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($shopstocks as $shopstock): ?>
                <tr>
                    <td><?= $Number++ ?></td>
                    <td><?= $this->Number->format($shopstock->id) ?></td>
                    <td><?= $shopstock->hasValue('product') ? $this->Html->link($shopstock->product->name, ['controller' => 'Products', 'action' => 'view', $shopstock->product->id]) : '' ?></td>
                    <td><?= $shopstock->hasValue('room') ? $this->Html->link($shopstock->room->name, ['controller' => 'Rooms', 'action' => 'view', $shopstock->room->id]) : '' ?></td>
                    <td><?= $shopstock->stock === null ? '' : $this->Number->format($shopstock->stock) ?></td>
                    <td><?= $shopstock->stock_min === null ? '' : $this->Number->format($shopstock->stock_min) ?></td>
                    <td><?= $shopstock->stock_max === null ? '' : $this->Number->format($shopstock->stock_max) ?></td>
                    <td><?= h($shopstock->created) ?></td>
                    <td><?= h($shopstock->modified) ?></td>
                    <td><?= h($shopstock->createdby) ?></td>
                    <td><?= h($shopstock->modifiedby) ?></td>
                    <td><?= h($shopstock->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Details'), ['action' => 'view', $shopstock->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Editer'), ['action' => 'edit', $shopstock->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $shopstock->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
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
        <h5 class="offcanvas-title" id="offcanvasRightLabel1">Nouveau Shopstocks</h5>
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
                <?= $this->Form->control('room_id', ['options' => $rooms, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'room_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('stock', ['class' => 'form-control', 'label' => 'stock']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('stock_min', ['class' => 'form-control', 'label' => 'stock_min']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('stock_max', ['class' => 'form-control', 'label' => 'stock_max']); ?>
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
                url: '<?= $this->Url->build(["controller" => 'Shopstocks', 'action' => 'insert']) ?>',
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