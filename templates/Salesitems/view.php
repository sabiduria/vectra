<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Salesitem $salesitem
 */
 $this->set('title_2', 'Salesitems');
?>
<div class="row">
    <div class="column column-80">
        <div class="salesitems view content">
            <h3><?= h($salesitem->id) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Product') ?></th>
                    <td><?= $salesitem->hasValue('product') ? $this->Html->link($salesitem->product->name, ['controller' => 'Products', 'action' => 'view', $salesitem->product->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Sale') ?></th>
                    <td><?= $salesitem->hasValue('sale') ? $this->Html->link($salesitem->sale->id, ['controller' => 'Sales', 'action' => 'view', $salesitem->sale->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Packaging') ?></th>
                    <td><?= $salesitem->hasValue('packaging') ? $this->Html->link($salesitem->packaging->name, ['controller' => 'Packagings', 'action' => 'view', $salesitem->packaging->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($salesitem->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($salesitem->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($salesitem->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Qty') ?></th>
                    <td><?= $salesitem->qty === null ? '' : $this->Number->format($salesitem->qty) ?></td>
                </tr>
                <tr>
                    <th><?= __('Unit Price') ?></th>
                    <td><?= $salesitem->unit_price === null ? '' : $this->Number->format($salesitem->unit_price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Subtotal') ?></th>
                    <td><?= $salesitem->subtotal === null ? '' : $this->Number->format($salesitem->subtotal) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($salesitem->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($salesitem->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $salesitem->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>