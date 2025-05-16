<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\GeneralParam> $generalParams
 */
$this->set('title_2', 'General Params');
$Number = 1;
?>
<div class="mt-3">
    <button class="btn btn-sm btn-primary-light mb-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#NewItem" aria-controls="NewItem"><i class="fa-thin fa-plus"></i> Ajouter</button>
    <?= $this->Html->link(__('Nouveau General Param'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100 TableData">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('N°') ?></th>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('rccm') ?></th>
                    <th><?= $this->Paginator->sort('idnat') ?></th>
                    <th><?= $this->Paginator->sort('impot') ?></th>
                    <th><?= $this->Paginator->sort('printer_name') ?></th>
                    <th><?= $this->Paginator->sort('printer_ip') ?></th>
                    <th><?= $this->Paginator->sort('growth') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($generalParams as $generalParam): ?>
                <tr>
                    <td><?= $Number++ ?></td>
                    <td><?= $this->Number->format($generalParam->id) ?></td>
                    <td><?= h($generalParam->rccm) ?></td>
                    <td><?= h($generalParam->idnat) ?></td>
                    <td><?= h($generalParam->impot) ?></td>
                    <td><?= h($generalParam->printer_name) ?></td>
                    <td><?= h($generalParam->printer_ip) ?></td>
                    <td><?= $generalParam->growth === null ? '' : $this->Number->format($generalParam->growth) ?></td>
                    <td><?= h($generalParam->created) ?></td>
                    <td><?= h($generalParam->modified) ?></td>
                    <td><?= h($generalParam->createdby) ?></td>
                    <td><?= h($generalParam->modifiedby) ?></td>
                    <td><?= h($generalParam->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Details'), ['action' => 'view', $generalParam->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Editer'), ['action' => 'edit', $generalParam->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $generalParam->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
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
        <h5 class="offcanvas-title" id="offcanvasRightLabel1">Nouveau General Params</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-3">
        <div class="row">
            <div id="response"></div>
<div class="mt-3">
    <?= $this->Form->create(null, ['id' => 'DataForm']);?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('rccm', ['class' => 'form-control', 'label' => 'rccm']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('idnat', ['class' => 'form-control', 'label' => 'idnat']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('impot', ['class' => 'form-control', 'label' => 'impot']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('printer_name', ['class' => 'form-control', 'label' => 'printer_name']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('printer_ip', ['class' => 'form-control', 'label' => 'printer_ip']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('growth', ['class' => 'form-control', 'label' => 'growth']); ?>
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
                url: '<?= $this->Url->build(["controller" => 'General Params', 'action' => 'insert']) ?>',
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