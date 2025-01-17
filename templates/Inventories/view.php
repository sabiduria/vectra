<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Inventory $inventory
 */
?>
<div class="row">
    <div class="column column-80">
        <div class="inventories view content">
            <h3><?= h($inventory->id) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Product') ?></th>
                    <td><?= $inventory->hasValue('product') ? $this->Html->link($inventory->product->name, ['controller' => 'Products', 'action' => 'view', $inventory->product->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Inventory Period') ?></th>
                    <td><?= h($inventory->inventory_period) ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($inventory->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($inventory->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($inventory->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Qty') ?></th>
                    <td><?= $inventory->qty === null ? '' : $this->Number->format($inventory->qty) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($inventory->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($inventory->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $inventory->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>