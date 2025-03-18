<?php

use App\Controller\GeneralController;

$categories = GeneralController::getAllCategories();
$itemsCount = GeneralController::getItemCount();
$posProduct = GeneralController::getPOSProduct();
?>

<!-- Start Row-1 -->
<div class="row">
    <div class="col-xxl-8">
        <?= $this->Form->create(null, ['controller' => 'sales', 'action'=>'pos']);?>
            <?= $this->Form->control('barcode', ['class' => 'form-control form-control-lg rounded-0', 'placeholder' => 'Code Barre', 'label' => false, 'required' => 'required']); ?>
        <?= $this->Form->end() ?>
        <hr>
        <div class="d-flex align-Items-center justify-content-between mb-3">
            <h6 class="fw-medium mb-0">Categories</h6>
            <div class="d-flex gap-2 align-items-center">
                <a class="categories-arrow left">
                    <i class="ri-arrow-left-s-line"></i>
                </a>
                <a class="categories-arrow right">
                    <i class="ri-arrow-right-s-line"></i>
                </a>
            </div>
        </div>
        <div class="row pos-category" id="filter">
            <div class="col-xl-3 col-md-6">
                <div class="card custom-card active">
                    <div class="card-body p-3">
                        <a href="javascript:void(0);" class="stretched-link categories" data-filter="*">
                            <div class="d-flex gap-2 categories-content">
                                <span class="avatar avatar-md">
                                    <?= $this->Html->image('menu.png') ?>
                                </span>
                                <div>
                                    <span class="fw-medium">Tous les produits</span>
                                    <span class="d-block op-7 fs-12"><?= $itemsCount ?> Items</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <?php foreach ($categories as $key=>$value): ?>
                <div class="col-xl-3 col-md-6">
                    <div class="card custom-card">
                        <div class="card-body p-3">
                            <a href="javascript:void(0);" class="stretched-link categories" data-filter=".<?= str_replace(' ', '', $value['name']) ?>">
                                <div class="d-flex gap-2 categories-content">
                                <span class="avatar avatar-md menu-icon">
                                    <?= $this->Html->image('category.png') ?>
                                </span>
                                    <div>
                                        <span class="fw-medium"><?= $value['name'] ?></span>
                                        <span class="d-block op-7 fs-12"><?= $value['product_count'] ?> Items</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="fw-medium mb-0">Listes</h6>
                </div>
                <div class="row list-wrapper">
                    <?php foreach ($posProduct as $key=>$value): ?>
                            <div class="col-xxl-4 col-xl-4 col-md-6 card-item <?= str_replace(' ', '', $value['category_name']) ?>" data-category="<?= str_replace(' ', '', $value['category_name']) ?>">
                                <div class="card custom-card p-3 p-3">
                                    <div class="card-body bg-secondary-transparent rounded-bottom">
                                        <div class="mb-3">
                                            <a href="javascript:void(0);" class="fw-medium fs-16"><?= $value['product_name'] ?></a>
                                            <span class="fs-12 text-muted d-block">Unité : <?= $value['packaging'] ?></span>
                                        </div>
                                        <div class="d-flex align-items-center gap-2 justify-content-between flex-wrap">
                                            <h5 class="fw-medium mb-0"><?= $value['unit_price'] ?></h5>
                                            <div>
                                                <?= $this->Form->create(null, ['controller' => 'sales', 'action'=>'pos']);?>
                                                <?= $this->Form->control('barcode', ['class' => 'form-control form-control-sm rounded-0', 'placeholder' => 'Code Barre', 'label' => false, 'type'=>'hidden', 'value' => $value['barcode']]); ?>
                                                <?= $this->Form->control('packaging_id', ['class' => 'form-control form-control-sm rounded-0', 'placeholder' => 'Code Barre', 'label' => false, 'type'=>'hidden', 'value' => $value['packaging_id']]); ?>
                                                <button type="submit" class="btn btn-primary btn-sm" data-bs-toggle="offcanvas" data-bs-target="#viewcart"><i class="ri-add-fill me-1"></i>Ajouter</button>
                                                <?= $this->Form->end() ?>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-4">
        <div class="card custom-card active">
            <div class="card-body p-0">
                <div class="">
                    <div class="p-3 border-bottom border-block-end-dashed">
                        <div class="row">
                            <?php if ($reference != null):?>
                                <div class="d-flex align-items-center justify-content-between flex-wrap">
                                    <div class="fs-12 fw-medium bg-primary-transparent p-1 px-2 rounded">Ref. Facture</div>
                                    <div class="text-success"><?= $reference ?></div>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                    <ul class="list-group mb-0 border-0 rounded-0">
                        <?php if ($salesDetails != null): ?>
                            <?php foreach ($salesDetails as $key=>$value) :?>
                                <li class="list-group-item border-top-0 border-start-0 border-end-0">
                                    <div class="d-flex align-items-start flex-wrap">
                                        <div class="me-2 lh-1">
                                        <span class="avatar avatar-xl bg-light">
                                            <?= $this->Html->image($value['image']) ?>
                                        </span>
                                        </div>
                                        <div class="flex-fill pt-3">
                                            <div class="d-flex align-items-center justify-content-between mb-3" data-product-id="<?= $value['product_id'] ?>">
                                                <div class="fw-medium fs-14"><?= $value['product'] ?></div>
                                                <div class="fw-medium fs-14 unit-price"><?= $value['unit_price'] ?></div>
                                                <div class="fw-medium fs-14" id="item-subtotal"><?= $value['subtotal'] ?></div>
                                                <div class="product-quantity-container order-summ">
                                                    <div class="input-group flex-nowrap gap-1 border rounded-pill p-1">
                                                        <button type="button" aria-label="button" class="btn btn-icon btn-sm border btn-wave rounded-pill btn-primary-light border product-quantity-minus border-end-0"><i class="ri-subtract-line"></i></button>
                                                        <input type="text" class="form-control form-control-sm border-0 text-center p-0 product-quantity" min="1" aria-label="quantity" value="<?= $value['qty'] ?>">
                                                        <button type="button" aria-label="button" class="btn btn-icon btn-sm border btn-wave rounded-pill btn-primary-light border product-quantity-plus border-start-0"><i class="ri-add-line"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>

                    <div class="p-3 border-bottom border-block-end-dashed">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="text-muted">Sous Total</div>
                            <div class="fw-medium fs-14">
                                <input id="subtotal" type="text" class="form-control form-control-light" placeholder="Enter Amount" value="<?= $salesAmount ?>" readonly>
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
                                <input id="vat" type="text" class="form-control form-control-light" placeholder="Enter Amount" value="<?= $vat ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="fs-15">Total :</div>
                            <div class="fw-semibold fs-16 text-dark">
                                <input id="total" type="text" class="form-control form-control-light" placeholder="Enter Amount" value="<?= $total ?>" readonly>
                            </div>
                        </div>
                        <div class="d-flex gap-3 mt-4">
                            <a href="javascript:void(0);" class="btn btn-primary1-light btn-wave flex-fill waves-effect waves-light">Annuler la facture</a>
                            <button class="btn btn-primary btn-wave flex-fill waves-effect waves-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#NewItem" aria-controls="NewItem">Valider la facture</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End::Row-1 -->

<div class="offcanvas offcanvas-end" tabindex="-1" id="NewItem"
     aria-labelledby="offcanvasRightLabel1">
    <div class="offcanvas-header border-bottom border-block-end-dashed">
        <h5 class="offcanvas-title" id="offcanvasRightLabel1">Validation Facture</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-3">
        <div class="row">
            <div id="response"></div>
            <div class="mt-3">
                <?= $this->Form->create(null, ['id' => 'DataForm']);?>
                <div class="row gy-2">
                    <div class="col-xl-12">
                        <?= $this->Form->control('client_code', ['class' => 'form-control', 'label' => 'Code du Client']); ?>
                    </div>
                    <div class="col-xl-12">
                        <?= $this->Form->control('client_name', ['class' => 'form-control', 'label' => 'Nom du Client', 'readonly']); ?>
                    </div>
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
                        <?= $this->Form->control('amount_difference', ['class' => 'form-control', 'label' => 'Difference', 'readonly']); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="p-3 border-bottom border-block-end-dashed">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="text-muted">Sous Total</div>
                            <div class="fw-medium fs-14">
                                <input type="text" class="form-control form-control-light" placeholder="Enter Amount" value="<?= $salesAmount ?>" readonly>
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
            </div>

        </div>
    </div>
</div>

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
                let total = subtotal + vat;

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
                            $("#vat").val(parsedResponse.vat);
                            $("#total").val(parsedResponse.total);
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
            var cumulated = amountCDF + (amountUSD * 2820);
            var difference = cumulated - TotalBill;
            //$("#amount_cumulated").val(cumulated.toFixed(2)); // Format to 2 decimal places
            $("#amount-difference").val(difference.toFixed(2)); // Format to 2 decimal places
        });

    });


</script>
