<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Accessright> $accessrights
 */
$this->set('title_2', 'Accessrights');
$Number = 1;
?>
<div class="mt-3">
    <button class="btn btn-sm btn-primary-light mb-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#NewItem" aria-controls="NewItem"><i class="fa-thin fa-plus"></i> Ajouter</button>
    <?= $this->Html->link(__('Nouveau Accessright'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100 TableData">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('N°') ?></th>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('profile_id') ?></th>
                    <th><?= $this->Paginator->sort('resource_id') ?></th>
                    <th><?= $this->Paginator->sort('c') ?></th>
                    <th><?= $this->Paginator->sort('r') ?></th>
                    <th><?= $this->Paginator->sort('u') ?></th>
                    <th><?= $this->Paginator->sort('d') ?></th>
                    <th><?= $this->Paginator->sort('p') ?></th>
                    <th><?= $this->Paginator->sort('v') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($accessrights as $accessright): ?>
                <tr>
                    <td><?= $Number++ ?></td>
                    <td><?= $this->Number->format($accessright->id) ?></td>
                    <td><?= $accessright->hasValue('profile') ? $this->Html->link($accessright->profile->name, ['controller' => 'Profiles', 'action' => 'view', $accessright->profile->id]) : '' ?></td>
                    <td><?= $accessright->hasValue('resource') ? $this->Html->link($accessright->resource->name, ['controller' => 'Resources', 'action' => 'view', $accessright->resource->id]) : '' ?></td>
                    <td><?= h($accessright->c) ?></td>
                    <td><?= h($accessright->r) ?></td>
                    <td><?= h($accessright->u) ?></td>
                    <td><?= h($accessright->d) ?></td>
                    <td><?= h($accessright->p) ?></td>
                    <td><?= h($accessright->v) ?></td>
                    <td><?= h($accessright->created) ?></td>
                    <td><?= h($accessright->modified) ?></td>
                    <td><?= h($accessright->createdby) ?></td>
                    <td><?= h($accessright->modifiedby) ?></td>
                    <td><?= h($accessright->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Details'), ['action' => 'view', $accessright->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Editer'), ['action' => 'edit', $accessright->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $accessright->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
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
        <h5 class="offcanvas-title" id="offcanvasRightLabel1">Nouveau Accessrights</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-3">
        <div class="row">
            <div id="response"></div>
<div class="mt-3">
    <?= $this->Form->create(null, ['id' => 'DataForm']);?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('profile_id', ['options' => $profiles, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'profile_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('resource_id', ['options' => $resources, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'resource_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('c', ['class' => 'form-control', 'label' => 'c']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('r', ['class' => 'form-control', 'label' => 'r']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('u', ['class' => 'form-control', 'label' => 'u']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('d', ['class' => 'form-control', 'label' => 'd']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('p', ['class' => 'form-control', 'label' => 'p']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('v', ['class' => 'form-control', 'label' => 'v']); ?>
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
                url: '<?= $this->Url->build(["controller" => 'Accessrights', 'action' => 'insert']) ?>',
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