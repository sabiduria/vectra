<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Stockin $stockin
 */
 $this->set('title_2', 'Stockins');
?>
<div class="row">
    <div class="column column-80">
        <div class="stockins view content">
            <h3><?= h($stockin->id) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Shop') ?></th>
                    <td><?= $stockin->hasValue('shop') ? $this->Html->link($stockin->shop->name, ['controller' => 'Shops', 'action' => 'view', $stockin->shop->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Reference') ?></th>
                    <td><?= h($stockin->reference) ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($stockin->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($stockin->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($stockin->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($stockin->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($stockin->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $stockin->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Stockinsdetails') ?></h4>
                <?php if (!empty($stockin->stockinsdetails)) : ?>
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
                        <?php foreach ($stockin->stockinsdetails as $stockinsdetail) : ?>
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
        </div>
    </div>
</div>