<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Purchasesitem $purchasesitem
 */
 $this->set('title_2', 'Purchasesitems');
$this->set('menu_purchases', 'active open');
?>
<div class="row">
    <div class="column column-80">
        <div class="purchasesitems view content">
            <h3><?= h($purchasesitem->id) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Purchase') ?></th>
                    <td><?= $purchasesitem->hasValue('purchase') ? $this->Html->link($purchasesitem->purchase->id, ['controller' => 'Purchases', 'action' => 'view', $purchasesitem->purchase->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Product') ?></th>
                    <td><?= $purchasesitem->hasValue('product') ? $this->Html->link($purchasesitem->product->name, ['controller' => 'Products', 'action' => 'view', $purchasesitem->product->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($purchasesitem->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($purchasesitem->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($purchasesitem->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Qty') ?></th>
                    <td><?= $purchasesitem->qty === null ? '' : $this->Number->format($purchasesitem->qty) ?></td>
                </tr>
                <tr>
                    <th><?= __('Price') ?></th>
                    <td><?= $purchasesitem->price === null ? '' : $this->Number->format($purchasesitem->price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($purchasesitem->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($purchasesitem->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $purchasesitem->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
