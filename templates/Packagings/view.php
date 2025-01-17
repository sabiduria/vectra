<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Packaging $packaging
 */
 $this->set('title_2', 'Packagings');
?>
<div class="row">
    <div class="column column-80">
        <div class="packagings view content">
            <h3><?= h($packaging->name) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($packaging->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($packaging->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($packaging->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($packaging->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($packaging->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($packaging->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $packaging->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Pricings') ?></h4>
                <?php if (!empty($packaging->pricings)) : ?>
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
                        <?php foreach ($packaging->pricings as $pricing) : ?>
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
                <h4><?= __('Related Products') ?></h4>
                <?php if (!empty($packaging->products)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Supplier Id') ?></th>
                            <th><?= __('Category Id') ?></th>
                            <th><?= __('Reference') ?></th>
                            <th><?= __('Barcode') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Specifications') ?></th>
                            <th><?= __('Notes') ?></th>
                            <th><?= __('Packaging Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($packaging->products as $product) : ?>
                        <tr>
                            <td><?= h($product->id) ?></td>
                            <td><?= h($product->supplier_id) ?></td>
                            <td><?= h($product->category_id) ?></td>
                            <td><?= h($product->reference) ?></td>
                            <td><?= h($product->barcode) ?></td>
                            <td><?= h($product->name) ?></td>
                            <td><?= h($product->specifications) ?></td>
                            <td><?= h($product->notes) ?></td>
                            <td><?= h($product->packaging_id) ?></td>
                            <td><?= h($product->created) ?></td>
                            <td><?= h($product->modified) ?></td>
                            <td><?= h($product->createdby) ?></td>
                            <td><?= h($product->modifiedby) ?></td>
                            <td><?= h($product->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Products', 'action' => 'view', $product->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Products', 'action' => 'edit', $product->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Products', 'action' => 'delete', $product->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Salesitems') ?></h4>
                <?php if (!empty($packaging->salesitems)) : ?>
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
                        <?php foreach ($packaging->salesitems as $salesitem) : ?>
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
        </div>
    </div>
</div>