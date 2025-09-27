<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sale $sale
 */

use App\Controller\GeneralController;

$exchangesRates = GeneralController::getLatestExchangeRate();
$business_name = GeneralController::getValueOf(1, "business_name", "GeneralParams");
$rccm = GeneralController::getValueOf(1, "rccm", "GeneralParams");
$idnat = GeneralController::getValueOf(1, "idnat", "GeneralParams");
$impot = GeneralController::getValueOf(1, "impot", "GeneralParams");
$address = GeneralController::getValueOf($sale->shop_id ?? 1, 'address', 'Shops');
$number = 1;

// Calculate totals
$subtotal = array_sum(array_map(fn($i) => $i->subtotal, $sale->salesitems));
$tax = $sale->tax ?? 0;
$total = $subtotal + $tax;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture #<?= h($sale->reference) ?></title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #333; }
        h4, h5, h6 { margin: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f5f5f5; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .mb-0 { margin-bottom: 0; }
        .mt-0 { margin-top: 0; }
        .fw-bold { font-weight: bold; }
        .invoice-header { margin-bottom: 20px; }
        .invoice-footer { margin-top: 50px; }
        .signature { border-bottom: 1px solid #000; width: 200px; height: 50px; display: inline-block; }
        .logo { height: 60px; margin-right: 15px; }
    </style>
</head>
<body>

<!-- Header -->
<div class="invoice-header">
    <table style="width:100%; border:none;">
        <tr>
            <td style="border:none;">
                <!-- Optional logo -->
                <img src="<?= WWW_ROOT . 'img/logo.png' ?>" alt="Logo" class="logo">
            </td>
            <td style="border:none;">
                <h4><?= strtoupper($business_name) ?></h4>
                <small>
                    RCCM: <?= $rccm ?> | ID NAT: <?= $idnat ?> | IMPOT: <?= $impot ?><br>
                    <?= $address ?>
                </small>
            </td>
            <td style="border:none; text-align:right;">
                <h5>FACTURE N° #<?= h($sale->reference) ?></h5>
                <small>Date: <?= date('d-m-Y', strtotime($sale->created)) ?></small>
            </td>
        </tr>
    </table>
</div>

<!-- Client Info -->
<table style="margin-top: 10px; border:none;">
    <tr>
        <td style="border:none; width:50%;">
            <h6>Facturé à :</h6>
            <p class="fw-bold mb-0"><?= strtoupper($sale->customer ? $sale->customer->name : "Client Ordinaire") ?></p>
            <p class="mb-0">Téléphone: <?= $sale->customer ? '(243)'.$sale->customer->phone : "Non Applicable" ?></p>
        </td>
        <td style="border:none; width:50%; text-align:right;">
            <h6>Informations de paiement :</h6>
            <p class="mb-0">Mode: <?= $sale->payment_method ?? "Non spécifié" ?></p>
            <p class="mb-0">Échéance: <?= date('d-m-Y', strtotime($sale->due_date ?? $sale->created)) ?></p>
        </td>
    </tr>
</table>

<!-- Items Table -->
<table>
    <thead>
    <tr>
        <th>N°</th>
        <th>Article</th>
        <th>Quantité</th>
        <th>Prix Unitaire (FC)</th>
        <th>Sous-Total (FC)</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($sale->salesitems as $item) : ?>
        <tr>
            <td class="text-center"><?= $number++ ?></td>
            <td><?= GeneralController::getNameOf($item->product_id, 'Products') ?></td>
            <td class="text-center"><?= h($item->qty) ?> <?= GeneralController::getNameOf($item->packaging_id, 'Packagings') ?></td>
            <td class="text-right"><?= number_format($item->unit_price, 2, ',', ' ') ?></td>
            <td class="text-right"><?= number_format($item->subtotal, 2, ',', ' ') ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    <tfoot>
    <tr>
        <th colspan="4" class="text-right">Sous-Total :</th>
        <th class="text-right"><?= number_format($subtotal, 2, ',', ' ') ?></th>
    </tr>
    <tr>
        <th colspan="4" class="text-right">Taxe :</th>
        <th class="text-right"><?= number_format($tax, 2, ',', ' ') ?></th>
    </tr>
    <tr>
        <th colspan="4" class="text-right">Total :</th>
        <th class="text-right"><?= number_format($total, 2, ',', ' ') ?></th>
    </tr>
    </tfoot>
</table>

<!-- Footer -->
<div class="invoice-footer">
    <table style="width:100%; border:none; margin-top:50px;">
        <tr>
            <td style="border:none;">
                <p>Merci pour votre confiance !</p>
            </td>
            <td style="border:none; text-align:right;">
                <p>Signature :</p>
                <div class="signature"></div>
            </td>
        </tr>
    </table>
</div>

</body>
</html>
