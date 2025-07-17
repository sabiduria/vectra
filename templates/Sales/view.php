<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sale $sale
 */

use App\Controller\GeneralController;

$this->set('title_2', 'Sales');
 $number = 1;
$this->set('menu_sales', 'active open');
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
                                <p class="fw-bold mb-1"> SPRUKO TECHNOLOGIES </p>
                                <p class="mb-1 text-muted"> WNN-A1-1323,Robsons street </p>
                                <p class="mb-1 text-muted"> Ottawa,Canada,100072 </p>
                                <p class="mb-1 text-muted"> sprukotrust.Xintra@gmail.com </p>
                                <p class="mb-1 text-muted"> (222) 142-1245 </p>
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

                    <div class="col-xl-12">
                        <div class="table-responsive">
                            <table class="table nowrap text-nowrap border mt-4">
                                <tr>
                                    <th><?= __('N°') ?></th>
                                    <th><?= __('Article') ?></th>
                                    <th><?= __('Qte') ?></th>
                                    <th><?= __('Packaging') ?></th>
                                    <th><?= __('Prix Unitaire') ?></th>
                                    <th><?= __('Sous-Total') ?></th>
                                    <th class="text-end"><?= __('Actions') ?></th>
                                </tr>
                                <?php foreach ($sale->salesitems as $salesitem) : ?>
                                    <tr>
                                        <td><?= $number++ ?></td>
                                        <td><?= GeneralController::getNameOf($salesitem->product_id, 'Products') ?></td>
                                        <td><?= h($salesitem->qty) ?></td>
                                        <td><?= GeneralController::getNameOf($salesitem->packaging_id, 'Packagings') ?></td>
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

                        <div class="text-end">
                            <button class="print-btn btn btn-success btn-sm mt-3">Imprimer</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
