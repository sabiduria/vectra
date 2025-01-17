<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Shopstock $shopstock
 */
 $this->set('title_2', 'Shopstocks');
?>
<div class="row">
    <div class="column column-80">
        <div class="shopstocks view content">
            <h3><?= h($shopstock->id) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Product') ?></th>
                    <td><?= $shopstock->hasValue('product') ? $this->Html->link($shopstock->product->name, ['controller' => 'Products', 'action' => 'view', $shopstock->product->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Room') ?></th>
                    <td><?= $shopstock->hasValue('room') ? $this->Html->link($shopstock->room->name, ['controller' => 'Rooms', 'action' => 'view', $shopstock->room->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($shopstock->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($shopstock->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($shopstock->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Stock') ?></th>
                    <td><?= $shopstock->stock === null ? '' : $this->Number->format($shopstock->stock) ?></td>
                </tr>
                <tr>
                    <th><?= __('Stock Min') ?></th>
                    <td><?= $shopstock->stock_min === null ? '' : $this->Number->format($shopstock->stock_min) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($shopstock->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($shopstock->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $shopstock->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>