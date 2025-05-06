<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ordersitem $ordersitem
 */
 $this->set('title_2', 'Ordersitems');
$this->set('menu_orders', 'active open');
?>
<div class="row">
    <div class="column column-80">
        <div class="ordersitems view content">
            <h3><?= h($ordersitem->id) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Product') ?></th>
                    <td><?= $ordersitem->hasValue('product') ? $this->Html->link($ordersitem->product->name, ['controller' => 'Products', 'action' => 'view', $ordersitem->product->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Order') ?></th>
                    <td><?= $ordersitem->hasValue('order') ? $this->Html->link($ordersitem->order->id, ['controller' => 'Orders', 'action' => 'view', $ordersitem->order->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($ordersitem->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Moodifiedby') ?></th>
                    <td><?= h($ordersitem->moodifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($ordersitem->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Qty') ?></th>
                    <td><?= $ordersitem->qty === null ? '' : $this->Number->format($ordersitem->qty) ?></td>
                </tr>
                <tr>
                    <th><?= __('Unit Price') ?></th>
                    <td><?= $ordersitem->unit_price === null ? '' : $this->Number->format($ordersitem->unit_price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Subtotal') ?></th>
                    <td><?= $ordersitem->subtotal === null ? '' : $this->Number->format($ordersitem->subtotal) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($ordersitem->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($ordersitem->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $ordersitem->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
