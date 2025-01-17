<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
 $this->set('title_2', 'Products');
?>
<div class="row">
    <div class="column column-80">
        <div class="products view content">
            <h3><?= h($product->name) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Supplier') ?></th>
                    <td><?= $product->hasValue('supplier') ? $this->Html->link($product->supplier->name, ['controller' => 'Suppliers', 'action' => 'view', $product->supplier->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Category') ?></th>
                    <td><?= $product->hasValue('category') ? $this->Html->link($product->category->name, ['controller' => 'Categories', 'action' => 'view', $product->category->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Reference') ?></th>
                    <td><?= h($product->reference) ?></td>
                </tr>
                <tr>
                    <th><?= __('Barcode') ?></th>
                    <td><?= h($product->barcode) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($product->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Packaging') ?></th>
                    <td><?= $product->hasValue('packaging') ? $this->Html->link($product->packaging->name, ['controller' => 'Packagings', 'action' => 'view', $product->packaging->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($product->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($product->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($product->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($product->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($product->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $product->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Specifications') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($product->specifications)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Notes') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($product->notes)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Inventories') ?></h4>
                <?php if (!empty($product->inventories)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Product Id') ?></th>
                            <th><?= __('Qty') ?></th>
                            <th><?= __('Inventory Period') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($product->inventories as $inventory) : ?>
                        <tr>
                            <td><?= h($inventory->id) ?></td>
                            <td><?= h($inventory->product_id) ?></td>
                            <td><?= h($inventory->qty) ?></td>
                            <td><?= h($inventory->inventory_period) ?></td>
                            <td><?= h($inventory->created) ?></td>
                            <td><?= h($inventory->modified) ?></td>
                            <td><?= h($inventory->createdby) ?></td>
                            <td><?= h($inventory->modifiedby) ?></td>
                            <td><?= h($inventory->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Inventories', 'action' => 'view', $inventory->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Inventories', 'action' => 'edit', $inventory->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Inventories', 'action' => 'delete', $inventory->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Ordersitems') ?></h4>
                <?php if (!empty($product->ordersitems)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Product Id') ?></th>
                            <th><?= __('Order Id') ?></th>
                            <th><?= __('Qty') ?></th>
                            <th><?= __('Unit Price') ?></th>
                            <th><?= __('Subtotal') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Moodifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($product->ordersitems as $ordersitem) : ?>
                        <tr>
                            <td><?= h($ordersitem->id) ?></td>
                            <td><?= h($ordersitem->product_id) ?></td>
                            <td><?= h($ordersitem->order_id) ?></td>
                            <td><?= h($ordersitem->qty) ?></td>
                            <td><?= h($ordersitem->unit_price) ?></td>
                            <td><?= h($ordersitem->subtotal) ?></td>
                            <td><?= h($ordersitem->created) ?></td>
                            <td><?= h($ordersitem->modified) ?></td>
                            <td><?= h($ordersitem->createdby) ?></td>
                            <td><?= h($ordersitem->moodifiedby) ?></td>
                            <td><?= h($ordersitem->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Ordersitems', 'action' => 'view', $ordersitem->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Ordersitems', 'action' => 'edit', $ordersitem->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Ordersitems', 'action' => 'delete', $ordersitem->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Pricings') ?></h4>
                <?php if (!empty($product->pricings)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Product Id') ?></th>
                            <th><?= __('Packaging Id') ?></th>
                            <th><?= __('Unit Price') ?></th>
                            <th><?= __('Wholesale Price') ?></th>
                            <th><?= __('Special Price') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($product->pricings as $pricing) : ?>
                        <tr>
                            <td><?= h($pricing->id) ?></td>
                            <td><?= h($pricing->product_id) ?></td>
                            <td><?= h($pricing->packaging_id) ?></td>
                            <td><?= h($pricing->unit_price) ?></td>
                            <td><?= h($pricing->wholesale_price) ?></td>
                            <td><?= h($pricing->special_price) ?></td>
                            <td><?= h($pricing->created) ?></td>
                            <td><?= h($pricing->modified) ?></td>
                            <td><?= h($pricing->createdby) ?></td>
                            <td><?= h($pricing->modifiedby) ?></td>
                            <td><?= h($pricing->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Pricings', 'action' => 'view', $pricing->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Pricings', 'action' => 'edit', $pricing->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Pricings', 'action' => 'delete', $pricing->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Promotionsproducts') ?></h4>
                <?php if (!empty($product->promotionsproducts)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Product Id') ?></th>
                            <th><?= __('Percent') ?></th>
                            <th><?= __('Startdate') ?></th>
                            <th><?= __('Enddate') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($product->promotionsproducts as $promotionsproduct) : ?>
                        <tr>
                            <td><?= h($promotionsproduct->id) ?></td>
                            <td><?= h($promotionsproduct->product_id) ?></td>
                            <td><?= h($promotionsproduct->percent) ?></td>
                            <td><?= h($promotionsproduct->startdate) ?></td>
                            <td><?= h($promotionsproduct->enddate) ?></td>
                            <td><?= h($promotionsproduct->created) ?></td>
                            <td><?= h($promotionsproduct->modified) ?></td>
                            <td><?= h($promotionsproduct->createdby) ?></td>
                            <td><?= h($promotionsproduct->modifiedby) ?></td>
                            <td><?= h($promotionsproduct->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Promotionsproducts', 'action' => 'view', $promotionsproduct->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Promotionsproducts', 'action' => 'edit', $promotionsproduct->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Promotionsproducts', 'action' => 'delete', $promotionsproduct->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Purchasesitems') ?></h4>
                <?php if (!empty($product->purchasesitems)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Purchase Id') ?></th>
                            <th><?= __('Product Id') ?></th>
                            <th><?= __('Qty') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($product->purchasesitems as $purchasesitem) : ?>
                        <tr>
                            <td><?= h($purchasesitem->id) ?></td>
                            <td><?= h($purchasesitem->purchase_id) ?></td>
                            <td><?= h($purchasesitem->product_id) ?></td>
                            <td><?= h($purchasesitem->qty) ?></td>
                            <td><?= h($purchasesitem->created) ?></td>
                            <td><?= h($purchasesitem->modified) ?></td>
                            <td><?= h($purchasesitem->createdby) ?></td>
                            <td><?= h($purchasesitem->modifiedby) ?></td>
                            <td><?= h($purchasesitem->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Purchasesitems', 'action' => 'view', $purchasesitem->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Purchasesitems', 'action' => 'edit', $purchasesitem->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Purchasesitems', 'action' => 'delete', $purchasesitem->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Salesitems') ?></h4>
                <?php if (!empty($product->salesitems)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Product Id') ?></th>
                            <th><?= __('Sale Id') ?></th>
                            <th><?= __('Qty') ?></th>
                            <th><?= __('Packaging Id') ?></th>
                            <th><?= __('Unit Price') ?></th>
                            <th><?= __('Subtotal') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($product->salesitems as $salesitem) : ?>
                        <tr>
                            <td><?= h($salesitem->id) ?></td>
                            <td><?= h($salesitem->product_id) ?></td>
                            <td><?= h($salesitem->sale_id) ?></td>
                            <td><?= h($salesitem->qty) ?></td>
                            <td><?= h($salesitem->packaging_id) ?></td>
                            <td><?= h($salesitem->unit_price) ?></td>
                            <td><?= h($salesitem->subtotal) ?></td>
                            <td><?= h($salesitem->created) ?></td>
                            <td><?= h($salesitem->modified) ?></td>
                            <td><?= h($salesitem->createdby) ?></td>
                            <td><?= h($salesitem->modifiedby) ?></td>
                            <td><?= h($salesitem->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Salesitems', 'action' => 'view', $salesitem->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Salesitems', 'action' => 'edit', $salesitem->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Salesitems', 'action' => 'delete', $salesitem->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Shopstocks') ?></h4>
                <?php if (!empty($product->shopstocks)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Product Id') ?></th>
                            <th><?= __('Room Id') ?></th>
                            <th><?= __('Stock') ?></th>
                            <th><?= __('Stock Min') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($product->shopstocks as $shopstock) : ?>
                        <tr>
                            <td><?= h($shopstock->id) ?></td>
                            <td><?= h($shopstock->product_id) ?></td>
                            <td><?= h($shopstock->room_id) ?></td>
                            <td><?= h($shopstock->stock) ?></td>
                            <td><?= h($shopstock->stock_min) ?></td>
                            <td><?= h($shopstock->created) ?></td>
                            <td><?= h($shopstock->modified) ?></td>
                            <td><?= h($shopstock->createdby) ?></td>
                            <td><?= h($shopstock->modifiedby) ?></td>
                            <td><?= h($shopstock->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Shopstocks', 'action' => 'view', $shopstock->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Shopstocks', 'action' => 'edit', $shopstock->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Shopstocks', 'action' => 'delete', $shopstock->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Spoilages') ?></h4>
                <?php if (!empty($product->spoilages)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Product Id') ?></th>
                            <th><?= __('Qty') ?></th>
                            <th><?= __('Reason') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($product->spoilages as $spoilage) : ?>
                        <tr>
                            <td><?= h($spoilage->id) ?></td>
                            <td><?= h($spoilage->product_id) ?></td>
                            <td><?= h($spoilage->qty) ?></td>
                            <td><?= h($spoilage->reason) ?></td>
                            <td><?= h($spoilage->created) ?></td>
                            <td><?= h($spoilage->modified) ?></td>
                            <td><?= h($spoilage->createdby) ?></td>
                            <td><?= h($spoilage->modifiedby) ?></td>
                            <td><?= h($spoilage->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Spoilages', 'action' => 'view', $spoilage->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Spoilages', 'action' => 'edit', $spoilage->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Spoilages', 'action' => 'delete', $spoilage->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Stockinsdetails') ?></h4>
                <?php if (!empty($product->stockinsdetails)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Product Id') ?></th>
                            <th><?= __('Stockin Id') ?></th>
                            <th><?= __('Purchase Price') ?></th>
                            <th><?= __('Barcode') ?></th>
                            <th><?= __('Qty') ?></th>
                            <th><?= __('Expiry Date') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($product->stockinsdetails as $stockinsdetail) : ?>
                        <tr>
                            <td><?= h($stockinsdetail->id) ?></td>
                            <td><?= h($stockinsdetail->product_id) ?></td>
                            <td><?= h($stockinsdetail->stockin_id) ?></td>
                            <td><?= h($stockinsdetail->purchase_price) ?></td>
                            <td><?= h($stockinsdetail->barcode) ?></td>
                            <td><?= h($stockinsdetail->qty) ?></td>
                            <td><?= h($stockinsdetail->expiry_date) ?></td>
                            <td><?= h($stockinsdetail->created) ?></td>
                            <td><?= h($stockinsdetail->modified) ?></td>
                            <td><?= h($stockinsdetail->createdby) ?></td>
                            <td><?= h($stockinsdetail->modifiedby) ?></td>
                            <td><?= h($stockinsdetail->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Stockinsdetails', 'action' => 'view', $stockinsdetail->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Stockinsdetails', 'action' => 'edit', $stockinsdetail->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Stockinsdetails', 'action' => 'delete', $stockinsdetail->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Transfersdetails') ?></h4>
                <?php if (!empty($product->transfersdetails)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Transfer Id') ?></th>
                            <th><?= __('Product Id') ?></th>
                            <th><?= __('Qty') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($product->transfersdetails as $transfersdetail) : ?>
                        <tr>
                            <td><?= h($transfersdetail->id) ?></td>
                            <td><?= h($transfersdetail->transfer_id) ?></td>
                            <td><?= h($transfersdetail->product_id) ?></td>
                            <td><?= h($transfersdetail->qty) ?></td>
                            <td><?= h($transfersdetail->created) ?></td>
                            <td><?= h($transfersdetail->modified) ?></td>
                            <td><?= h($transfersdetail->createdby) ?></td>
                            <td><?= h($transfersdetail->modifiedby) ?></td>
                            <td><?= h($transfersdetail->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Transfersdetails', 'action' => 'view', $transfersdetail->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Transfersdetails', 'action' => 'edit', $transfersdetail->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Transfersdetails', 'action' => 'delete', $transfersdetail->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
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