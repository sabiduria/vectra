<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */

use App\Controller\GeneralController;

$this->set('title_2', 'Articles');
?>
<div class="row">
    <div class="column column-80">
        <div class="products view content pt-4">
            <div class="row">
                <div class="col-sm-2">
                    <?= $this->Html->image($product->image, ['style' => 'width : 100%']) ?>
                </div>
                <div class="col-sm-10">
                    <h3><?= h($product->name) ?> (# <?= h($product->reference) ?>)</h3>
                    <div class="row mt-3">
                        <div class="col-sm-6">
                            <table class="table table-sm table-bordered">
                                <tr>
                                    <th><?= __('Fournisseur') ?></th>
                                    <td><?= $product->hasValue('supplier') ? $this->Html->link($product->supplier->name, ['controller' => 'Suppliers', 'action' => 'view', $product->supplier->id]) : '' ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Catégorie') ?></th>
                                    <td><?= $product->hasValue('category') ? $this->Html->link($product->category->name, ['controller' => 'Categories', 'action' => 'view', $product->category->id]) : '' ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <strong><?= __('Specifications') ?></strong>
                                        <blockquote>
                                            <?= $this->Text->autoParagraph(h($product->specifications)); ?>
                                        </blockquote>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-sm-6">
                            <table class="table table-sm table-bordered">
                                <tr>
                                    <th><?= __('Barcode') ?></th>
                                    <td><?= h($product->barcode) ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Packaging') ?></th>
                                    <td><?= $product->hasValue('packaging') ? $this->Html->link($product->packaging->name, ['controller' => 'Packagings', 'action' => 'view', $product->packaging->id]) : '' ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <strong><?= __('Notes') ?></strong>
                                        <blockquote>
                                            <?= $this->Text->autoParagraph(h($product->notes)); ?>
                                        </blockquote>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="related p-2 mb-3" style="border: 1px solid #e0e0e0">
                <h6><?= __('Inventaires Manuels') ?></h6>
                <?php if (!empty($product->inventories)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Qte') ?></th>
                            <th><?= __('Periode') ?></th>
                            <th><?= __('Date') ?></th>
                            <th><?= __('Par') ?></th>
                            <th class="text-end"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($product->inventories as $inventory) : ?>
                        <tr>
                            <td><?= h($inventory->id) ?></td>
                            <td><?= h($inventory->qty) ?></td>
                            <td><?= h($inventory->inventory_period) ?></td>
                            <td><?= h($inventory->created) ?></td>
                            <td><?= h($inventory->createdby) ?></td>
                            <td class="text-end">
                                <?= $this->Html->link(__('Details'), ['controller' => 'Inventories', 'action' => 'view', $inventory->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Editer'), ['controller' => 'Inventories', 'action' => 'edit', $inventory->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Inventories', 'action' => 'delete', $inventory->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php else: ?>
                    Aucune donnée disponible
                <?php endif; ?>
            </div>

            <div class="related p-2 mb-3" style="border: 1px solid #e0e0e0">
                <h6><?= __('Commandes') ?></h6>
                <?php if (!empty($product->ordersitems)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Reference') ?></th>
                            <th><?= __('Qte') ?></th>
                            <th><?= __('Prix Unitaire') ?></th>
                            <th><?= __('Total') ?></th>
                            <th><?= __('Date') ?></th>
                            <th><?= __('Par') ?></th>
                            <th class="text-end"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($product->ordersitems as $ordersitem) : ?>
                        <tr>
                            <td><?= h($ordersitem->id) ?></td>
                            <td><?= GeneralController::getReferenceOf($ordersitem->order_id, 'Orders') ?></td>
                            <td><?= h($ordersitem->qty) ?></td>
                            <td><?= h($ordersitem->unit_price) ?></td>
                            <td><?= h($ordersitem->subtotal) ?></td>
                            <td><?= h($ordersitem->created) ?></td>
                            <td><?= h($ordersitem->createdby) ?></td>
                            <td class="text-end">
                                <?= $this->Html->link(__('Details'), ['controller' => 'Ordersitems', 'action' => 'view', $ordersitem->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Editer'), ['controller' => 'Ordersitems', 'action' => 'edit', $ordersitem->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Ordersitems', 'action' => 'delete', $ordersitem->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php else: ?>
                    Aucune donnée disponible
                <?php endif; ?>
            </div>

            <div class="related p-2 mb-3" style="border: 1px solid #e0e0e0">
                <h6><?= __('Pricings') ?></h6>
                <?php if (!empty($product->pricings)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Packaging') ?></th>
                            <th><?= __('Price Unitaire') ?></th>
                            <th><?= __('Prix de gros') ?></th>
                            <th><?= __('Prix Special') ?></th>
                            <th><?= __('Date') ?></th>
                            <th><?= __('Par') ?></th>
                            <th class="text-end"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($product->pricings as $pricing) : ?>
                        <tr>
                            <td><?= h($pricing->id) ?></td>
                            <td><?= GeneralController::getNameOf($pricing->packaging_id, 'Packagings') ?></td>
                            <td><?= h($pricing->unit_price) ?></td>
                            <td><?= h($pricing->wholesale_price) ?></td>
                            <td><?= h($pricing->special_price) ?></td>
                            <td><?= h($pricing->created) ?></td>
                            <td><?= h($pricing->createdby) ?></td>
                            <td class="text-end">
                                <?= $this->Html->link(__('Details'), ['controller' => 'Pricings', 'action' => 'view', $pricing->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Editer'), ['controller' => 'Pricings', 'action' => 'edit', $pricing->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Pricings', 'action' => 'delete', $pricing->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php else: ?>
                    Aucune donnée disponible
                <?php endif; ?>
            </div>

            <div class="related p-2 mb-3" style="border: 1px solid #e0e0e0">
                <h6><?= __('Promotions') ?></h6>
                <?php if (!empty($product->promotionsproducts)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Pourcentage') ?></th>
                            <th><?= __('Date debut') ?></th>
                            <th><?= __('Date fin') ?></th>
                            <th><?= __('Date') ?></th>
                            <th><?= __('Par') ?></th>
                            <th class="text-end"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($product->promotionsproducts as $promotionsproduct) : ?>
                        <tr>
                            <td><?= h($promotionsproduct->id) ?></td>
                            <td><?= h($promotionsproduct->percent) ?></td>
                            <td><?= h($promotionsproduct->startdate) ?></td>
                            <td><?= h($promotionsproduct->enddate) ?></td>
                            <td><?= h($promotionsproduct->created) ?></td>
                            <td><?= h($promotionsproduct->createdby) ?></td>
                            <td class="text-end">
                                <?= $this->Html->link(__('Details'), ['controller' => 'Promotionsproducts', 'action' => 'view', $promotionsproduct->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Editer'), ['controller' => 'Promotionsproducts', 'action' => 'edit', $promotionsproduct->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Promotionsproducts', 'action' => 'delete', $promotionsproduct->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php else: ?>
                    Aucune donnée disponible
                <?php endif; ?>
            </div>

            <div class="related p-2 mb-3" style="border: 1px solid #e0e0e0">
                <h6><?= __('Achats') ?></h6>
                <?php if (!empty($product->purchasesitems)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Reference') ?></th>
                            <th><?= __('Qte') ?></th>
                            <th><?= __('Date') ?></th>
                            <th><?= __('Par') ?></th>
                            <th class="text-end"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($product->purchasesitems as $purchasesitem) : ?>
                        <tr>
                            <td><?= h($purchasesitem->id) ?></td>
                            <td><?= GeneralController::getReferenceOf($purchasesitem->purchase_id, 'Purchases') ?></td>
                            <td><?= h($purchasesitem->qty) ?></td>
                            <td><?= h($purchasesitem->created) ?></td>
                            <td><?= h($purchasesitem->createdby) ?></td>
                            <td class="text-end">
                                <?= $this->Html->link(__('Details'), ['controller' => 'Purchasesitems', 'action' => 'view', $purchasesitem->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Editer'), ['controller' => 'Purchasesitems', 'action' => 'edit', $purchasesitem->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Purchasesitems', 'action' => 'delete', $purchasesitem->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php else: ?>
                    Aucune donnée disponible
                <?php endif; ?>
            </div>

            <div class="related p-2 mb-3" style="border: 1px solid #e0e0e0">
                <h6><?= __('Ventes') ?></h6>
                <?php if (!empty($product->salesitems)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Reference') ?></th>
                            <th><?= __('Qte') ?></th>
                            <th><?= __('Packaging') ?></th>
                            <th><?= __('Prix Unitaire') ?></th>
                            <th><?= __('Total') ?></th>
                            <th><?= __('Date') ?></th>
                            <th><?= __('Par') ?></th>
                            <th class="text-end"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($product->salesitems as $salesitem) : ?>
                        <tr>
                            <td><?= h($salesitem->id) ?></td>
                            <td><?= GeneralController::getReferenceOf($salesitem->sale_id, 'Sales') ?></td>
                            <td><?= h($salesitem->qty) ?></td>
                            <td><?= GeneralController::getNameOf($salesitem->packaging_id, 'Packagings') ?></td>
                            <td><?= h($salesitem->unit_price) ?></td>
                            <td><?= h($salesitem->subtotal) ?></td>
                            <td><?= h($salesitem->modified) ?></td>
                            <td><?= h($salesitem->createdby) ?></td>
                            <td class="text-end">
                                <?= $this->Html->link(__('Details'), ['controller' => 'Salesitems', 'action' => 'view', $salesitem->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Editer'), ['controller' => 'Salesitems', 'action' => 'edit', $salesitem->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Salesitems', 'action' => 'delete', $salesitem->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php else: ?>
                    Aucune donnée disponible
                <?php endif; ?>
            </div>

            <div class="related p-2 mb-3" style="border: 1px solid #e0e0e0">
                <h6><?= __('Stocks') ?></h6>
                <?php if (!empty($product->shopstocks)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Chambre') ?></th>
                            <th><?= __('Stock') ?></th>
                            <th><?= __('Stock Min') ?></th>
                            <th><?= __('Stock Max') ?></th>
                            <th><?= __('Etat') ?></th>
                            <th><?= __('Date') ?></th>
                            <th><?= __('Par') ?></th>
                            <th class="text-end"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($product->shopstocks as $shopstock) : ?>
                        <tr>
                            <td><?= h($shopstock->id) ?></td>
                            <td><?= GeneralController::getNameOf($shopstock->room_id, 'Rooms') ?></td>
                            <td><?= h($shopstock->stock) ?></td>
                            <td><?= h($shopstock->stock_min) ?></td>
                            <td><?= h($shopstock->stock_max) ?></td>
                            <td><?= $shopstock->stock <= $shopstock->stock_min ? "<span class='badge bg-danger-transparent ms-2'>Attention</span>" : "<span class='badge bg-success-transparent ms-2'>Disponible</span>" ?></td>
                            <td><?= h($shopstock->created) ?></td>
                            <td><?= h($shopstock->createdby) ?></td>
                            <td class="text-end">
                                <?= $this->Html->link(__('Details'), ['controller' => 'Shopstocks', 'action' => 'view', $shopstock->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Editer'), ['controller' => 'Shopstocks', 'action' => 'edit', $shopstock->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Shopstocks', 'action' => 'delete', $shopstock->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php else: ?>
                    Aucune donnée disponible
                <?php endif; ?>
            </div>

            <div class="related p-2 mb-3" style="border: 1px solid #e0e0e0">
                <h6><?= __('Déclassés') ?></h6>
                <?php if (!empty($product->spoilages)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Qte') ?></th>
                            <th><?= __('Raison') ?></th>
                            <th><?= __('Date') ?></th>
                            <th><?= __('Par') ?></th>
                            <th class="text-end"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($product->spoilages as $spoilage) : ?>
                        <tr>
                            <td><?= h($spoilage->id) ?></td>
                            <td><?= h($spoilage->qty) ?></td>
                            <td><?= h($spoilage->reason) ?></td>
                            <td><?= h($spoilage->created) ?></td>
                            <td><?= h($spoilage->createdby) ?></td>
                            <td class="text-end">
                                <?= $this->Html->link(__('Details'), ['controller' => 'Spoilages', 'action' => 'view', $spoilage->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Editer'), ['controller' => 'Spoilages', 'action' => 'edit', $spoilage->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Spoilages', 'action' => 'delete', $spoilage->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php else: ?>
                    Aucune donnée disponible
                <?php endif; ?>
            </div>

            <div class="related p-2 mb-3" style="border: 1px solid #e0e0e0">
                <h6><?= __('Entrées') ?></h6>
                <?php if (!empty($product->stockinsdetails)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Reference') ?></th>
                            <th><?= __('Prix d\'achat') ?></th>
                            <th><?= __('Tax') ?></th>
                            <th><?= __('Total') ?></th>
                            <th><?= __('Barcode') ?></th>
                            <th><?= __('Qté') ?></th>
                            <th><?= __('Date Expiration') ?></th>
                            <th><?= __('Date') ?></th>
                            <th><?= __('Par') ?></th>
                            <th class="text-end"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($product->stockinsdetails as $stockinsdetail) : ?>
                        <tr>
                            <td><?= h($stockinsdetail->id) ?></td>
                            <td><?= GeneralController::getReferenceOf($stockinsdetail->stockin_id, 'Stockins') ?></td>
                            <td><?= h($stockinsdetail->purchase_price) ?></td>
                            <td><?= h($stockinsdetail->tax) ?></td>
                            <td><?= h($stockinsdetail->purchase_price + $stockinsdetail->tax) ?></td>
                            <td><?= h($stockinsdetail->barcode) ?></td>
                            <td><?= h($stockinsdetail->qty) ?></td>
                            <td><?= h($stockinsdetail->expiry_date) ?></td>
                            <td><?= h($stockinsdetail->created) ?></td>
                            <td><?= h($stockinsdetail->createdby) ?></td>
                            <td class="text-end">
                                <?= $this->Html->link(__('Details'), ['controller' => 'Stockinsdetails', 'action' => 'view', $stockinsdetail->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Editer'), ['controller' => 'Stockinsdetails', 'action' => 'edit', $stockinsdetail->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Stockinsdetails', 'action' => 'delete', $stockinsdetail->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php else: ?>
                    Aucune donnée disponible
                <?php endif; ?>
            </div>

            <div class="related p-2 mb-3" style="border: 1px solid #e0e0e0">
                <h6><?= __('Transferts') ?></h6>
                <?php if (!empty($product->transfersdetails)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Reference') ?></th>
                            <th><?= __('Qte') ?></th>
                            <th><?= __('Date') ?></th>
                            <th><?= __('Par') ?></th>
                            <th class="text-end"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($product->transfersdetails as $transfersdetail) : ?>
                        <tr>
                            <td><?= h($transfersdetail->id) ?></td>
                            <td><?= GeneralController::getReferenceOf($transfersdetail->transfer_id, 'Transfers') ?></td>
                            <td><?= h($transfersdetail->qty) ?></td>
                            <td><?= h($transfersdetail->created) ?></td>
                            <td><?= h($transfersdetail->createdby) ?></td>
                            <td class="text-end">
                                <?= $this->Html->link(__('Details'), ['controller' => 'Transfersdetails', 'action' => 'view', $transfersdetail->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Editer'), ['controller' => 'Transfersdetails', 'action' => 'edit', $transfersdetail->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Transfersdetails', 'action' => 'delete', $transfersdetail->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php else: ?>
                    Aucune donnée disponible
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
