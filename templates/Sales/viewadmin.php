<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sale $sale
 */

use App\Controller\GeneralController;

$session = $this->request->getSession();
$this->set('title_2', 'Sales');
$number = 1;
$exchangesRates = GeneralController::getLatestExchangeRate();
$this->set('menu_sales', 'active open');
$business_name = GeneralController::getValueOf(1, "business_name", "GeneralParams");
$rccm = GeneralController::getValueOf(1, "rccm", "GeneralParams");
$idnat = GeneralController::getValueOf(1, "idnat", "GeneralParams");
$impot = GeneralController::getValueOf(1, "impot", "GeneralParams");
$address = GeneralController::getValueOf($session->read('Auth.ShopId'), 'address', 'Shops');

$logoFile = WWW_ROOT . 'img' . DS . 'logo.png';
$logoData = base64_encode(file_get_contents($logoFile));
?>
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0" id="invoice">
            <!-- Header -->
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <!-- Company Info -->
                    <div class="d-flex align-items-center">
                        <!-- Optional Logo -->
                        <img src="data:image/png;base64,<?= $logoData ?>" alt="Logo" style="height:60px; margin-right:15px;">
                        <div>
                            <h4 class="mb-0 text-uppercase"><?= $business_name ?></h4>
                            <small class="text-muted d-block">
                                RCCM: <?= $rccm ?> <br>ID NAT: <?= $idnat ?> <br> IMPOT: <?= $impot ?><br>
                                <?= $address ?>
                            </small>
                        </div>
                    </div>

                    <!-- Invoice Info -->
                    <div class="text-end">
                        <h5 class="text-primary mb-1">FACTURE N° <span>#<?= h($sale->reference) ?></span></h5>
                        <small class="text-muted">Date: <?= date('d-m-Y', strtotime($sale->created)) ?></small>
                    </div>
                </div>
            </div>

            <!-- Client Info -->
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted">Facturée à :</h6>
                        <p class="fw-bold mb-1">
                            <?= strtoupper($sale->customer ? $sale->customer->name : "Client Ordinaire") ?>
                        </p>
                        <p class="mb-1 text-muted">
                            Téléphone : <?= $sale->customer ? '(243)'.$sale->customer->phone : "Non Applicable" ?>
                        </p>
                    </div>
                    <div class="col-md-6 text-md-end mt-3 mt-md-0">
                        <h6 class="text-muted">Informations de paiement :</h6>
                        <p class="mb-1 text-muted">Mode: <?= $sale->payment_method ?? "Non spécifié" ?></p>
                        <p class="mb-1 text-muted">Échéance: <?= date('d-m-Y', strtotime($sale->due_date ?? $sale->created)) ?></p>
                    </div>
                </div>

                <!-- Items Table -->
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Article</th>
                            <th>Quantité</th>
                            <th>Prix Unitaire (FC)</th>
                            <th>Sous-Total (FC)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $number = 1; ?>
                        <?php foreach ($sale->salesitems as $item) : ?>
                            <tr>
                                <td><?= $number++ ?></td>
                                <td><?= GeneralController::getNameOf($item->product_id, 'Products') ?></td>
                                <td>
                                    <?= h($item->qty) ?> <?= GeneralController::getNameOf($item->packaging_id, 'Packagings') ?>
                                </td>
                                <td><?= number_format($item->unit_price, 2, ',', ' ') ?></td>
                                <td><?= number_format($item->subtotal, 2, ',', ' ') ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot class="fw-bold">
                        <?php
                        $subtotal = array_sum(array_map(fn($i) => $i->subtotal, $sale->salesitems));
                        $tax = $sale->tax ?? 0; // Optional tax
                        $total = $subtotal + $tax;
                        ?>
                        <tr>
                            <td colspan="4" class="text-end">Sous-Total :</td>
                            <td><?= number_format($subtotal, 2, ',', ' ') ?></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-end">Taxe (<?= $tax > 0 ? "TVA" : "0" ?>) :</td>
                            <td><?= number_format($tax, 2, ',', ' ') ?></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-end">Total :</td>
                            <td><?= number_format($total, 2, ',', ' ') ?></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Footer -->
                <div class="row mt-5">
                    <div class="col-md-6">
                        <p class="mb-0">Merci pour votre confiance !</p>
                    </div>
                    <div class="col-md-6 text-md-end mt-3 mt-md-0">
                        <p class="mb-0">Signature :</p>
                        <div style="height: 50px; border-bottom: 1px solid #000; width: 200px; display: inline-block;"></div>
                    </div>

                    <div class="col-sm-12 text-end">
                        <?= $this->Html->link('Télécharger PDF', ['action' => 'printInvoice', $sale->id], ['class' => 'btn btn-primary', 'target' => '_blank']) ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Print friendly styles */
    @media print {
        body * {
            visibility: hidden;
        }
        #invoice, #invoice * {
            visibility: visible;
        }
        #invoice {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
    }
</style>


