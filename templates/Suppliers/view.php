<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Supplier $supplier
 */
?>
<div class="row">
    <div class="column column-80">
        <div class="suppliers view content">
            <h3><?= h($supplier->name) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($supplier->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Address') ?></th>
                    <td><?= h($supplier->address) ?></td>
                </tr>
                <tr>
                    <th><?= __('Phone1') ?></th>
                    <td><?= h($supplier->phone1) ?></td>
                </tr>
                <tr>
                    <th><?= __('Phone2') ?></th>
                    <td><?= h($supplier->phone2) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($supplier->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($supplier->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($supplier->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($supplier->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($supplier->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($supplier->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $supplier->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Products') ?></h4>
                <?php if (!empty($supplier->products)) : ?>
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
                        <?php foreach ($supplier->products as $product) : ?>
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
                <h4><?= __('Related Purchases') ?></h4>
                <?php if (!empty($supplier->purchases)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Status Id') ?></th>
                            <th><?= __('Supplier Id') ?></th>
                            <th><?= __('Reference') ?></th>
                            <th><?= __('Qty') ?></th>
                            <th><?= __('Receipt Date') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($supplier->purchases as $purchase) : ?>
                        <tr>
                            <td><?= h($purchase->id) ?></td>
                            <td><?= h($purchase->status_id) ?></td>
                            <td><?= h($purchase->supplier_id) ?></td>
                            <td><?= h($purchase->reference) ?></td>
                            <td><?= h($purchase->qty) ?></td>
                            <td><?= h($purchase->receipt_date) ?></td>
                            <td><?= h($purchase->created) ?></td>
                            <td><?= h($purchase->modified) ?></td>
                            <td><?= h($purchase->createdby) ?></td>
                            <td><?= h($purchase->modifiedby) ?></td>
                            <td><?= h($purchase->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Purchases', 'action' => 'view', $purchase->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Purchases', 'action' => 'edit', $purchase->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Purchases', 'action' => 'delete', $purchase->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
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