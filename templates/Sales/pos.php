<?php
?>

<div class="row">
    <div class="col-xl-9">
        <?= $this->Form->create(null, ['controller' => 'sales', 'action'=>'pos']);?>
            <?= $this->Form->control('barcode', ['class' => 'form-control form-control-lg rounded-0', 'placeholder' => 'Code Barre', 'label' => false, 'required' => 'required']); ?>
        <?= $this->Form->end() ?>
        <div class="table-responsive">
            <table class="table nowrap text-nowrap border mt-3">
                <thead>
                <tr>
                    <th>ARTICLE</th>
                    <th>QUANTITE</th>
                    <th>PRIX UNITAIRE</th>
                    <th>UNITE</th>
                    <th>TOTAL</th>
                    <th>ACTION</th>
                </tr>
                </thead>
                <tbody>
                <?php if ($salesDetails != null): ?>
                    <?php foreach ($salesDetails as $key=>$value) :?>
                    <tr data-product-id="<?= $value['product_id'] ?>">
                        <td>
                            <input value="<?= $value['product'] ?>" type="text" class="form-control form-control-light" placeholder="Enter Product Name">
                        </td>
                        <td class="invoice-quantity-container">
                            <div class="input-group border rounded flex-nowrap">
                                <!--button class="btn btn-icon btn-primary input-group-text flex-fill product-quantity-minus"><i class="ri-subtract-line"></i></button-->
                                <input type="text" class="form-control form-control-sm border-0 text-center w-100" aria-label="quantity" id="product-quantity" value="<?= $value['qty'] ?>">
                                <!--button class="btn btn-icon btn-primary input-group-text flex-fill product-quantity-plus"><i class="ri-add-line"></i></button-->
                            </div>
                        </td>
                        <td><input class="form-control form-control-light" placeholder="" type="text" value="<?= $value['unit_price'] ?>" readonly></td>
                        <td><input class="form-control form-control-light" placeholder="" type="text" value="<?= $value['packaging'] ?>"></td>
                        <td><input class="form-control form-control-light" placeholder="" type="text" value="<?= $value['subtotal'] ?>" readonly></td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-icon btn-danger-light"><i class="ri-delete-bin-5-line"></i></button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-xl-3">
        <div class="col-sm-12">
            <div class="row">
                <?php if ($reference != null):?>
                    <h4 class="text-end">Ref. <?= $reference ?></h4>
                <?php endif ?>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-sm text-nowrap mt-3 table-borderless">
                <tbody>
                <tr>
                    <th scope="row">
                        <div class="fw-medium">Sous Total :</div>
                    </th>
                    <td>
                        <input id="subtotal" type="text" class="form-control form-control-light" placeholder="Enter Amount" value="<?= $this->Number->format($salesAmount) ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <div class="fw-medium">Remise :</div>
                    </th>
                    <td>
                        <input type="text" class="form-control form-control-light" placeholder="Enter Amount" value="0" readonly>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <div class="fw-medium">TVA <span class="text-danger">(15%)</span> :</div>
                    </th>
                    <td>
                        <input id="vat" type="text" class="form-control form-control-light" placeholder="Enter Amount" value="<?= $vat ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <div class="fs-14 fw-medium">Total :</div>
                    </th>
                    <td>
                        <input id="total" type="text" class="form-control form-control-light" placeholder="Enter Amount" value="<?= $total ?>" readonly>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(".invoice-quantity-container input").on("change", function() {
            let qty = $(this).val(); // Get the updated quantity value
            let productId = $(this).closest("tr").data("product-id"); // Get the product ID from the row data (add a custom data attribute to the row)
            let row = $(this).closest("tr");
            let unitPrice = parseFloat(row.find("td:eq(2) input").val()); // Get the unit price from the table
            let subtotal = qty * unitPrice; // Calculate the new subtotal

            // Update the subtotal input field
            row.find("td:eq(4) input").val(subtotal);
            document.getElementById("subtotal").value = subtotal;

            let vat = (subtotal*15)/100;

            document.getElementById("vat").value = vat;
            document.getElementById("total").value = subtotal + vat;

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
                        var parsedResponse = JSON.parse(response);  // Ensure it's parsed as JSON

                        console.log(parsedResponse); // Log the parsed response

                        /*if (parsedResponse.success) {
                            alert(parsedResponse.message);  // Show success message
                        } else {
                            alert(parsedResponse.message);  // Show failure message
                        }*/
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
</script>
