<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Stockinsdetail $stockinsdetail
 */
 $this->set('title_2', 'Stockinsdetails');
$this->set('menu_stock', 'active open');
?>
<div class="row">
    <div class="column column-80">
        <div class="stockinsdetails view content">
            <h3><?= h($stockinsdetail->id) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Product') ?></th>
                    <td><?= $stockinsdetail->hasValue('product') ? $this->Html->link($stockinsdetail->product->name, ['controller' => 'Products', 'action' => 'view', $stockinsdetail->product->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Stockin') ?></th>
                    <td><?= $stockinsdetail->hasValue('stockin') ? $this->Html->link($stockinsdetail->stockin->id, ['controller' => 'Stockins', 'action' => 'view', $stockinsdetail->stockin->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Room') ?></th>
                    <td><?= $stockinsdetail->hasValue('room') ? $this->Html->link($stockinsdetail->room->name, ['controller' => 'Rooms', 'action' => 'view', $stockinsdetail->room->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Barcode') ?></th>
                    <td><?= h($stockinsdetail->barcode) ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($stockinsdetail->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($stockinsdetail->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($stockinsdetail->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Purchase Price') ?></th>
                    <td><?= $stockinsdetail->purchase_price === null ? '' : $this->Number->format($stockinsdetail->purchase_price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tax') ?></th>
                    <td><?= $stockinsdetail->tax === null ? '' : $this->Number->format($stockinsdetail->tax) ?></td>
                </tr>
                <tr>
                    <th><?= __('Qty') ?></th>
                    <td><?= $stockinsdetail->qty === null ? '' : $this->Number->format($stockinsdetail->qty) ?></td>
                </tr>
                <tr>
                    <th><?= __('Entry State') ?></th>
                    <td><?= $stockinsdetail->entry_state === null ? '' : $this->Number->format($stockinsdetail->entry_state) ?></td>
                </tr>
                <tr>
                    <th><?= __('Expiry Date') ?></th>
                    <td><?= h($stockinsdetail->expiry_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($stockinsdetail->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($stockinsdetail->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $stockinsdetail->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
