<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Purchase $purchase
 */

use App\Controller\GeneralController;

$this->set('title_2', 'Bon d\'Achats');
$number = 1;
$number1 = 1;
$number2 = 1;
$payment_number = 1;
$emptyText = "Veuillez selectionner";

?>
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header d-md-flex d-block">
                <div class="h5 mb-0 d-sm-flex d-block align-items-center">
                    <div class="">
                        <div class="h6 fw-medium mb-0">BON D'ACHATS : <span class="text-primary">#<?= h($purchase->reference) ?></span></div>
                    </div>
                </div>
                <div class="ms-auto mt-md-0 mt-2">
                    <button class="btn btn-sm btn-primary1 me-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#NewItem" aria-controls="NewItem">
                        Ajouter les dépenses<i class="ri-wallet-2-line ms-1 align-middle d-inline-block"></i>
                    </button>
                    <button class="btn btn-sm btn-success me-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#NewPayment" aria-controls="NewPayment">
                        Nouveau paiement<i class="ri-wallet-2-line ms-1 align-middle d-inline-block"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row gy-3">
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                <p class="text-muted mb-2">
                                    Information du Fournisseur :
                                </p>
                                <p class="fw-bold mb-1">
                                    <?= $purchase->supplier->name ?>
                                </p>
                                <p class="mb-1 text-muted">
                                    <?= GeneralController::getSupplierData('address', $purchase->supplier_id) ?>
                                </p>
                                <p class="mb-1 text-muted">
                                    <?= GeneralController::getSupplierData('phone1', $purchase->supplier_id) ?> / <?= GeneralController::getSupplierData('phone2', $purchase->supplier_id) ?>
                                </p>
                                <p class="mb-1 text-muted">
                                    <?= GeneralController::getSupplierData('email', $purchase->supplier_id) ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-xl-3">
                        <p class="fw-medium text-muted mb-1">ID Bon d'achat :</p>
                        <p class="fs-15 mb-1">#<?= $purchase->reference ?></p>
                    </div>
                    <div class="col-xl-3">
                        <p class="fw-medium text-muted mb-1">Date Emission :</p>
                        <p class="fs-15 mb-1"><?= date('Y-m-d', strtotime($purchase->created)) ?></p>
                    </div>
                    <div class="col-xl-3">
                        <p class="fw-medium text-muted mb-1">Date Livraison :</p>
                        <p class="fs-15 mb-1"><?= date('Y-m-d', strtotime($purchase->due_date)) ?></p>
                    </div>
                    <div class="col-xl-3">
                        <p class="fw-medium text-muted mb-1">Somme Totale :</p>
                        <p class="fs-16 mb-1 fw-medium"><?= GeneralController::getPOAmount($purchase->id) ?></p>
                    </div>
                    <div class="col-xl-12">
                        <div class="table-responsive">
                            <table class="table nowrap text-nowrap border mt-4">
                                <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>ARTICLE</th>
                                    <th>QUANTITE</th>
                                    <th>PRIX UNITAIRE</th>
                                    <th>TOTAL</th>
                                    <th class="text-end"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($purchase->purchasesitems as $purchasesitem) : ?>
                                    <tr>
                                        <td><?= $number++ ?></td>
                                        <td><?= GeneralController::getNameOf($purchasesitem->product_id, 'Products') ?></td>
                                        <td><?= h($purchasesitem->qty) ?></td>
                                        <td><?= h($purchasesitem->price) ?></td>
                                        <td><?= h($purchasesitem->qty * $purchasesitem->price) ?></td>
                                        <td class="text-end">
                                            <?= $this->Html->link(__('<i class="ri-pencil-line"></i>'), ['controller' => 'Purchasesitems', 'action' => 'edit', $purchasesitem->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                                            <?= $this->Form->postLink(__('<i class="ri-delete-bin-line"></i>'), ['controller' => 'Purchasesitems', 'action' => 'delete', $purchasesitem->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?'), 'escape' => false]) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--div class="col-xl-12">
                        <div>
                            <label for="invoice-note" class="form-label">Note:</label>
                            <textarea class="form-control form-control-light" id="invoice-note" rows="3">If you're not satisfied with the product, you can return the unused item within 10 days of the delivery date. For refund options, please visit the official website and review the available refund policies.</textarea>
                        </div>
                    </div-->
                </div>
            </div>
        </div>
    </div>

    <div class="column column-80">
        <div class="purchases view content">
            <div class="related">
                <h6><?= __('Paiements') ?></h6>
                <?php if (!empty($purchase->paymentstosuppliers)) : ?>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th><?= __('N°') ?></th>
                                <th><?= __('Description') ?></th>
                                <th><?= __('Montant') ?></th>
                                <th><?= __('Date') ?></th>
                                <th><?= __('Par') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                            <?php foreach ($purchase->paymentstosuppliers as $paymentstosupplier) : ?>
                                <tr>
                                    <td><?= $number1++ ?></td>
                                    <td><?= h($paymentstosupplier->description) ?></td>
                                    <td><?= h($paymentstosupplier->amount) ?></td>
                                    <td><?= h($paymentstosupplier->created) ?></td>
                                    <td><?= h($paymentstosupplier->createdby) ?></td>
                                    <td class="text-end">
                                        <?= $this->Html->link(__('<i class="ri-eye-line"></i>'), ['controller' => 'Paymentstosuppliers', 'action' => 'view', $paymentstosupplier->id], ['class' => 'btn btn-success btn-sm', 'escape' => false]) ?>
                                        <?= $this->Html->link(__('<i class="ri-pencil-line"></i>'), ['controller' => 'Paymentstosuppliers', 'action' => 'edit', $paymentstosupplier->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                                        <?= $this->Form->postLink(__('<i class="ri-delete-bin-line"></i>'), ['controller' => 'Paymentstosuppliers', 'action' => 'delete', $paymentstosupplier->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?'), 'escape' => false]) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                <?php endif; ?>
            </div>

            <br>

            <div class="related">
                <h6><?= __('Depenses') ?></h6>
                <?php if (!empty($purchase->spents)) : ?>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th><?= __('Id') ?></th>
                                <th><?= __('Type') ?></th>
                                <th><?= __('Description') ?></th>
                                <th><?= __('Montant') ?></th>
                                <th><?= __('Date') ?></th>
                                <th><?= __('Par') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                            <?php foreach ($purchase->spents as $spent) : ?>
                                <tr>
                                    <td><?= $number2++ ?></td>
                                    <td><?= GeneralController::getNameOf($spent->spenttype_id, 'Spenttypes') ?></td>
                                    <td><?= h($spent->description) ?></td>
                                    <td><?= h($spent->amount) ?></td>
                                    <td><?= h($spent->created) ?></td>
                                    <td><?= h($spent->createdby) ?></td>
                                    <td class="text-end">
                                        <?= $this->Html->link(__('<i class="ri-eye-line"></i>'), ['controller' => 'Spents', 'action' => 'view', $spent->id], ['class' => 'btn btn-success btn-sm', 'escape' => false]) ?>
                                        <?= $this->Html->link(__('<i class="ri-pencil-line"></i>'), ['controller' => 'Spents', 'action' => 'edit', $spent->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                                        <?= $this->Form->postLink(__('<i class="ri-delete-bin-line"></i>'), ['controller' => 'Spents', 'action' => 'delete', $spent->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?'), 'escape' => false]) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="NewItem"
     aria-labelledby="offcanvasRightLabel1">
    <div class="offcanvas-header border-bottom border-block-end-dashed">
        <h5 class="offcanvas-title" id="offcanvasRightLabel1">Dépenses</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-3">
        <div class="row">
            <div id="response"></div>
            <div class="mt-3">
                <?= $this->Form->create(null, ['id' => 'DataForm']);?>
                <div class="row gy-2">
                    <div class="col-xl-12">
                        <?= $this->Form->control('spenttype_id', ['options' => $spenttypes, 'empty' => $emptyText, 'class' => 'form-select', 'label' => 'Type depense']); ?>
                    </div>
                    <div class="col-xl-12">
                        <?= $this->Form->control('description', ['type' => 'textarea', 'class' => 'form-control', 'label' => 'Description']); ?>
                    </div>
                    <div class="col-xl-12">
                        <?= $this->Form->control('amount', ['min' => 0, 'type' => 'number', 'class' => 'form-control', 'label' => 'Montant']); ?>
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
                url: '<?= $this->Url->build(["controller" => 'Spents', 'action' => 'insert', $purchase->id]) ?>',
                method: 'POST',
                data: formData,
                dataType: 'json', // Expecting JSON in the response
                success: function(response) {
                    console.log(response.data); // Log the JSON response
                    $('#response').html('<div class="alert alert-success rounded-pill alert-dismissible fade show mb-1 mt-2">' + response.message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="bi bi-x"></i></button> </div>'); // Show success message
                    var newRow = '<tr>';
                    newRow += '<td>'+''+'</td>'; // Add your actions
                    newRow += '</tr>';

                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(error); // Log any error
                    $('#response').html('<p>An error occurred. Please try again.</p>');
                }
            });
        });
    });
</script>

<div class="offcanvas offcanvas-end" tabindex="-1" id="NewPayment"
     aria-labelledby="offcanvasRightLabel1">
    <div class="offcanvas-header border-bottom border-block-end-dashed">
        <h5 class="offcanvas-title" id="offcanvasRightLabel1">Nouveau Paymentstosuppliers</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-3">
        <div class="row">
            <div id="response"></div>
            <div class="mt-3">
                <?= $this->Form->create(null, ['id' => 'DataForm2']);?>
                <div class="row gy-2">
                    <div class="col-xl-12">
                        <?= $this->Form->control('description', ['type' => 'textarea', 'class' => 'form-control', 'label' => 'Description']); ?>
                    </div>
                    <div class="col-xl-12">
                        <?= $this->Form->control('amount', ['class' => 'form-control', 'label' => 'Montant']); ?>
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
        $('#DataForm2').on('submit', function(e) {
            e.preventDefault(); // Prevent default form submission
            // Get form data
            var formData = $(this).serialize();

            // Perform AJAX request
            $.ajax({
                url: '<?= $this->Url->build(["controller" => 'Paymentstosuppliers', 'action' => 'insert', $purchase->id]) ?>',
                method: 'POST',
                data: formData,
                dataType: 'json', // Expecting JSON in the response
                success: function(response) {
                    console.log(response.data); // Log the JSON response
                    $('#response').html('<div class="alert alert-success rounded-pill alert-dismissible fade show mb-1 mt-2">' + response.message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="bi bi-x"></i></button> </div>'); // Show success message
                    location.reload();
                    $('#DataForm2')[0].reset();
                },
                error: function(xhr, status, error) {
                    console.error(error); // Log any error
                    $('#response').html('<p>An error occurred. Please try again.</p>');
                }
            });
        });
    });
</script>

