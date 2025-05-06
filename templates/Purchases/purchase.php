<?php

use App\Controller\GeneralController;

$this->set('title_2', 'Achats');
$emptyText = "Veuillez selectionner";
$products = GeneralController::getAllProducts(1);
$number = 1;
$this->set('menu_purchases', 'active open');
?>

<div class="row" style="height: 70vh">
    <div class="col-sm-4">
        <div class="card custom-card" style="height: 70vh; overflow-y: scroll;">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 15%"></th>
                            <th>Produit</th>
                            <th>Min</th>
                            <th>Max</th>
                            <th>Stock</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($products as $key=>$value) :?>
                        <tr>
                            <th><?= $this->Html->image($value['image'], ['style' => 'width : 100%']) ?></th>
                            <th><?= $value['name'] ?></th>
                            <th><?= $value['stock_min'] ?></th>
                            <th><?= $value['stock_max'] ?></th>
                            <th><?= $value['stock'] ?></th>
                            <th>
                                <?= $this->Html->link(__('<i class="ri-arrow-right-circle-line"></i>'), ['action' => 'purchase', $value['id']], ['class' => 'btn btn-icon btn-secondary-light', 'escape' => false]) ?>
                            </th>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="card custom-card" style="overflow-y: scroll; height:70vh;">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Fournisseur</th>
                            <th>Unité</th>
                            <th style="width: 15%">Date</th>
                            <th>Prix</th>
                            <th style="width: 15%">Qté</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($prospections as $key=>$value): ?>
                            <tr>
                                <td><?= $value['supplier'] ?></td>
                                <td><?= $value['packaging'] ?></td>
                                <td><?= date('Y-m-d', strtotime($value['created'])) ?></td>
                                <td><?= $value['price'] ?></td>
                                <?= $this->Form->create(null, ['action'=>'purchase']);?>
                                    <td>
                                        <?= $this->Form->control('Qty', ['class' => 'form-control', 'label' => false, 'type' => 'number', 'min' => 1, 'required' => 'required']); ?>
                                        <?= $this->Form->control('SupplierId', ['class' => 'form-control', 'label' => false, 'type' => 'hidden', 'value' => $value['supplier_id']]); ?>
                                        <?= $this->Form->control('ProductId', ['class' => 'form-control', 'label' => false, 'type' => 'hidden', 'value' => $value['product_id']]); ?>
                                        <?= $this->Form->control('Price', ['class' => 'form-control', 'label' => false, 'type' => 'hidden', 'value' => $value['price']]); ?>
                                    </td>
                                    <td>
                                        <?= $this->Form->button(__('+'), ['class' => 'btn btn-icon btn-secondary-light', 'escape' => false]) ?>
                                    </td>
                                <?= $this->Form->end() ?>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <div class="text-end">
                    <button class="btn btn-primary btn-sm mb-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop"><i class="ri-shopping-basket-line"></i> Panier</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop"
     aria-labelledby="offcanvasTopLabel" style="height: 70vh">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasTopLabel">Details Achats #<?= $reference ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100 TableData">
            <thead>
            <tr>
                <th style="width: 5%">N°</th>
                <th style="width: 15%">Fournisseur</th>
                <th style="width: 20%">Article</th>
                <th>Prix</th>
                <th>Qté</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($PODetails as $key => $value): ?>
                <tr>
                    <td><?= $number++ ?></td>
                    <td><?= $value['supplier'] ?></td>
                    <td><?= $this->Html->image($value['image'], ['style' => 'width:15%']) ?> <?= $value['product'] ?></td>
                    <td><?= $value['price'] ?></td>
                    <td><?= $value['qty'] ?></td>
                    <td><?= $value['total'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <div class="text-end">
            <?= $this->Html->link(__('Continuer <i class="ri-arrow-right-circle-line"></i>'), ['controller' => 'purchasegroups', 'action' => 'view', $reference], ['class' => 'btn btn-success btn-sm', 'escape' => false]) ?>
        </div>
    </div>
</div>
