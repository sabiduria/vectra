<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Exchangerate> $exchangerates
 */

use App\Controller\GeneralController;

$this->set('title_2', 'Exchangerates');
$Number = 1;
?>
<div class="mt-3">
    <button class="btn btn-sm btn-primary-light mb-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#NewItem" aria-controls="NewItem"><i class="fa-thin fa-plus"></i> Ajouter</button>
    <?= $this->Html->link(__('Monnaies'), ['controller' => 'currencies', 'action' => 'index'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100 TableData">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('N°') ?></th>
                    <th><?= $this->Paginator->sort('Devise 1') ?></th>
                    <th><?= $this->Paginator->sort('Devise 2') ?></th>
                    <th><?= $this->Paginator->sort('Taux') ?></th>
                    <th><?= $this->Paginator->sort('Status') ?></th>
                    <th><?= $this->Paginator->sort('Date') ?></th>
                    <th><?= $this->Paginator->sort('Par') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($exchangerates as $exchangerate): ?>
                <tr>
                    <td><?= $Number++ ?></td>
                    <td><?= GeneralController::getNameOf($exchangerate->currency_from, 'Currencies') ?></td>
                    <td><?= GeneralController::getNameOf($exchangerate->currency_to, 'Currencies') ?></td>
                    <td><?= $exchangerate->rates === null ? '' : $this->Number->format($exchangerate->rates) ?></td>
                    <td><?= $exchangerate->isactived == 1 ? '<span class="badge bg-success-transparent">Actif</span>' : '<span class="badge bg-danger-transparent">Expiré</span>' ?></td>
                    <td><?= h($exchangerate->created) ?></td>
                    <td><?= h($exchangerate->createdby) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Details'), ['action' => 'view', $exchangerate->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Editer'), ['action' => 'edit', $exchangerate->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $exchangerate->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
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
        <h5 class="offcanvas-title" id="offcanvasRightLabel1">Nouveau Taux d'echanges</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-3">
        <div class="row">
            <div id="response"></div>
<div class="mt-3">
    <?= $this->Form->create(null, ['id' => 'DataForm']);?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('currency_from', ['options' => $currencies, 'class' => 'form-control', 'label' => 'Devise 1']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('currency_to', ['options' => $currencies, 'class' => 'form-control', 'label' => 'Devise 2']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('rates', ['class' => 'form-control', 'label' => 'Taux']); ?>
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
                url: '<?= $this->Url->build(["controller" => 'Exchangerates', 'action' => 'insert']) ?>',
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
                    window. location. reload();
                },
                error: function(xhr, status, error) {
                    console.error(error); // Log any error
                    $('#response').html('<p>An error occurred. Please try again.</p>');
                }
            });
        });
    });
</script>
