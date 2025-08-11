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

?>
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header d-md-flex d-block">
                <div class="h5 mb-0 d-sm-flex d-block align-items-center">
                    <div class="">
                        <div class="h6 fw-medium mb-0">FACTURE N° : <span class="text-primary">#<?= h($sale->reference) ?></span></div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row gy-3">

                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                <p class="text-muted mb-2"> Facturée par : </p>
                                <p class="fw-bold mb-1"> <?= strtoupper($business_name) ?> </p>
                                <p class="mb-1 text-muted"> No. RCCM : <?= $rccm ?> </p>
                                <p class="mb-1 text-muted"> ID. NAT : <?= $idnat ?> </p>
                                <p class="mb-1 text-muted"> No. IMPOT : <?= $impot ?> </p>
                                <p class="mb-1 text-muted"> Adresse : <?= $address ?> </p>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 ms-auto mt-sm-0 mt-3">
                                <p class="text-muted mb-2"> Facturée à : </p>
                                <p class="fw-bold mb-1">
                                    <?= strtoupper($sale->customer !=null ? $sale->customer->name : "Client Ordinaire") ?>
                                </p>
                                <p class="mb-1 text-muted">
                                    Telephone : <?= $sale->customer !=null ? '(243)'.$sale->customer->phone : "Non Applicable" ?>
                                </p>
                                <p class="mb-1 text-muted"> Date : <?= date('d-m-y', strtotime($sale->created)) ?> </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-7">
                        <div class="table-responsive">
                            <table class="table nowrap text-nowrap border mt-4">
                                <tr>
                                    <th><?= __('N°') ?></th>
                                    <th><?= __('Article') ?></th>
                                    <th><?= __('Qte') ?></th>
                                    <th><?= __('Prix Unitaire') ?></th>
                                    <th><?= __('Sous-Total') ?></th>
                                </tr>
                                <?php foreach ($sale->salesitems as $salesitem) : ?>
                                    <tr>
                                        <td><?= $number++ ?></td>
                                        <td><?= GeneralController::getNameOf($salesitem->product_id, 'Products') ?></td>
                                        <td>
                                            <?= h($salesitem->qty) ?>
                                            <?= GeneralController::getNameOf($salesitem->packaging_id, 'Packagings') ?>
                                        </td>
                                        <td><?= h($salesitem->unit_price) ?></td>
                                        <td><?= h($salesitem->subtotal) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>

                        <div class="row">
                            <div class="p-3 border-bottom border-block-end-dashed">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="text-muted">Sous Total</div>
                                    <div class="fw-medium fs-14">
                                        <input id="SalesAmountBill" type="text" class="form-control form-control-light" placeholder="Enter Amount" value="<?= $salesAmount ?>" readonly>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="text-muted">Remise</div>
                                    <div class="fw-medium fs-14">
                                        <input type="text" class="form-control form-control-light" placeholder="Enter Amount" value="0" readonly>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="text-muted">TVA (15%)</div>
                                    <div class="fw-medium fs-14">
                                        <input type="text" class="form-control form-control-light" placeholder="Enter Amount" value="<?= $vat ?>" readonly>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="fs-15">Total :</div>
                                    <div class="fw-semibold fs-16 text-dark">
                                        <input id="TotalBill" type="text" class="form-control form-control-light" placeholder="Enter Amount" value="<?= $total ?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5">
                        <table class="table nowrap text-nowrap border mt-4">
                            <tr>
                                <th>Paiement Facture</th>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row gy-2">
                                        <div class="col-xl-6">
                                            <label for="amount_cdf">Montant en FC</label>
                                            <div class="input-group mb-3">
                                                <input type="number" name="amount_cdf" class="form-control" id="amount_cdf">
                                                <span class="input-group-text">FC</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <label for="amount_usd">Montant en $</label>
                                            <div class="input-group mb-3">
                                                <input type="number" name="amount_usd" class="form-control" id="amount_usd">
                                                <span class="input-group-text">$</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <label for="">Difference</label>
                                            <div class="input-group mb-3">
                                                <input class="form-control" id="amount-difference" readonly>
                                                <span class="input-group-text">OU</span>
                                                <input class="form-control" id="amount-difference-usd" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3 mb-3 text-end">
                                        <button id="print-label-btn"
                                                class="btn btn-success btn-sm"
                                                data-url="<?= $this->Url->build(["controller" => 'Sales', 'action' => 'print', $sale->id]) ?>">
                                            Valider & Imprimer
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $("#amount_usd, #amount_cdf").on("change", function () {
            var amountUSD = parseFloat($("#amount_usd").val()) || 0;
            var amountCDF = parseFloat($("#amount_cdf").val()) || 0;
            var TotalBill = parseFloat($("#TotalBill").val()) || 0;
            var cumulated = amountCDF + (amountUSD * <?= $exchangesRates ?>);
            var difference = cumulated - TotalBill;
            var difference_usd = difference / <?= $exchangesRates ?>;

            if(difference < 0){
                document.getElementById("amount-difference").classList.add('text-danger');
                document.getElementById("amount-difference").classList.remove('text-success');

                document.getElementById("amount-difference-usd").classList.add('text-danger');
                document.getElementById("amount-difference-usd").classList.remove('text-success');
            } else{
                document.getElementById("amount-difference").classList.remove('text-danger');
                document.getElementById("amount-difference").classList.add('text-success');

                document.getElementById("amount-difference-usd").classList.remove('text-danger');
                document.getElementById("amount-difference-usd").classList.add('text-success');
            }

            //$("#amount_cumulated").val(cumulated.toFixed(2)); // Format to 2 decimal places
            $("#amount-difference").val(difference.toFixed(2) + " CDF"); // Format to 2 decimal places
            $("#amount-difference-usd").val(difference_usd.toFixed(2) + " USD"); // Format to 2 decimal places
        });

    });
</script>

<script>
    document.getElementById('print-label-btn').addEventListener('click', function () {
        const url = this.getAttribute('data-url');

        console.log("Fetching URL:", url);

        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-Token': '<?= $this->request->getAttribute("csrfToken") ?>',
                'Accept': 'application/json'
            }
        })
            .then(response => {
                if (!response.ok) throw new Error("HTTP " + response.status);
                return response.json();
            })
            .then(data => {
                Toastify({
                    text: data.success ? (data.message || "Facture Imprimée") : (data.error || "Erreur d'impression"),
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    backgroundColor: data.success ? "#4fbe87" : "#ff6b6b",
                    stopOnFocus: true
                }).showToast();
            })
            .catch(error => {
                Toastify({
                    text: "Erreur Technique: " + error.message,
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#ff6b6b"
                }).showToast();
            });

    });
</script>


