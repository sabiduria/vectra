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
                                    <th class="text-end"><?= __('Actions') ?></th>
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
                                        <td class="text-end">
                                            <?= $this->Html->link(__('<i class="ri-pencil-line"></i>'), ['controller' => 'Salesitems', 'action' => 'edit', $salesitem->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                                            <?= $this->Form->postLink(__('<i class="ri-delete-bin-line"></i>'), ['controller' => 'Salesitems', 'action' => 'delete', $salesitem->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?'), 'escape' => false]) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                    <div class="col-xl-5">
                        <table class="table nowrap text-nowrap border mt-4">
                            <tr>
                                <th>Paiement Facture</th>
                            </tr>
                            <tr>
                                <td>
                                    <?= $this->Form->create(null, ['id' => 'DataForm', 'action' => 'updateBill']);?>
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
                                                <input type="number" class="form-control" id="amount-difference" readonly>
                                                <span class="input-group-text">OU</span>
                                                <input type="number" class="form-control" id="amount-difference-usd" readonly>
                                            </div>
                                        </div>
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
                                    <div class="mt-3 mb-3">
                                        <?= $this->Form->button(__('Valider'), ['class'=>'btn btn-success']) ?>
                                    </div>
                                    <?= $this->Form->end() ?>
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
    $(document).ready(function() {
        "use strict";

        // Number of products selected
        let minValue = 1,
            maxValue = 300;

        document.querySelectorAll(".product-quantity-minus").forEach((element) => {
            element.onclick = () => {
                let input = element.nextElementSibling; // Selects the input field
                let value = Number(input.value);
                if (value > minValue) {
                    input.value = value - 1;
                    input.dispatchEvent(new Event("change")); // Triggers change event
                }
            };
        });

        document.querySelectorAll(".product-quantity-plus").forEach((element) => {
            element.onclick = () => {
                let input = element.previousElementSibling; // Selects the input field
                let value = Number(input.value);
                if (value < maxValue) {
                    input.value = value + 1;
                    input.dispatchEvent(new Event("change")); // Triggers change event
                }
            };
        });

        // Listen for the change event on quantity inputs
        document.querySelectorAll(".product-quantity").forEach((input) => {
            input.addEventListener("change", function () {
                let row = $(this).closest(".d-flex"); // Get the product row
                let qty = parseInt($(this).val()) || 1; // Get the updated quantity (ensure it's a valid number)
                let productId = row.data("product-id"); // Get the product ID
                let unitPrice = parseFloat(row.find(".unit-price").text()) || 0; // Get the unit price
                let subtotal = qty * unitPrice; // Calculate new subtotal

                // Update the subtotal
                row.find("#item-subtotal").text(subtotal);

                let vat = (subtotal * 15) / 100;
                let total = subtotal;

                // Send AJAX request to update the quantity and subtotal
                $.ajax({
                    url: '<?= $this->Url->build(["controller" => 'Sales', 'action' => 'updateItem']) ?>',
                    type: "POST",
                    data: {
                        product_id: productId,
                        qty: qty,
                        subtotal: subtotal,
                        _csrfToken: $("input[name='_csrfToken']").val()  // CSRF token from the hidden field
                    },
                    success: function(response) {
                        console.log(response);
                        try {
                            // Manually parse the response if necessary
                            let parsedResponse = JSON.parse(response);  // Ensure it's parsed as JSON

                            console.log(parsedResponse); // Log the parsed response

                            $("#subtotal").val(parsedResponse.subtotal);
                            $("#SalesAmountBill").val(parsedResponse.subtotal);
                            $("#vat").val(parsedResponse.vat);
                            $("#total").val(parsedResponse.total);
                            $("#TotalBill").val(parsedResponse.total);
                        } catch (e) {
                            console.error('Error parsing JSON response:', e);
                            alert("Error parsing response");
                        }
                    },
                    error: function() {
                        alert("Error in updating item");
                    }
                });
            });
        });

    });

    $(document).ready(function () {
        $("#client-code").on("change", function () {
            var clientCode = $(this).val();

            if (clientCode !== "") {
                $.ajax({
                    url: "<?= $this->Url->build(["controller" => 'Customers', 'action' => 'getClientInfo']) ?>",
                    type: "GET",
                    data: { client_code: clientCode },
                    dataType: "json",
                    success: function (response) {
                        if (response.success) {
                            $("#client-name").val(response.client_name);
                        } else {
                            //alert("Client not found!");
                            $("#client-name").val("");
                        }
                    },
                    error: function () {
                        alert("An error occurred while fetching client details.");
                    }
                });
            }
        });

        $("#amount_usd, #amount_cdf").on("change", function () {
            var amountUSD = parseFloat($("#amount_usd").val()) || 0;
            var amountCDF = parseFloat($("#amount_cdf").val()) || 0;
            var TotalBill = parseFloat($("#TotalBill").val()) || 0;
            var cumulated = amountCDF + (amountUSD * <?= $exchangesRates ?>);
            var difference = cumulated - TotalBill;
            var difference_usd = difference / <?= $exchangesRates ?>;
            //$("#amount_cumulated").val(cumulated.toFixed(2)); // Format to 2 decimal places
            $("#amount-difference").val(difference.toFixed(2)); // Format to 2 decimal places
            $("#amount-difference-usd").val(difference_usd.toFixed(2)); // Format to 2 decimal places
        });

    });


</script>

<script>
    $(document).on('click', '.print-btn', function (e) {
        e.preventDefault();

        $.ajax({
            url: '<?= $this->Url->build(["controller" => 'Sales', 'action' => 'print', $sale->id]) ?>',
            type: 'POST',
            dataType: 'json',
            headers: {
                'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') // Include CSRF token
            },
            success: function (data) {
                if (data.response.status === 'success') {
                    alert('Print job sent successfully.');
                } else {
                    alert('Error: ' + (data.message || 'Unknown error'));
                    //alert('Error: ' + data.response.message);
                }
            },
            error: function (xhr) {
                alert('AJAX Error: ' + xhr.statusText);
            }
        });
    });
</script>
