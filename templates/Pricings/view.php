<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pricing $pricing
 */
 $this->set('title_2', 'Pricings');
?>
<div class="row">
    <div class="column column-80">
        <div class="pricings view content">
            <h3><?= h($pricing->id) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Product') ?></th>
                    <td><?= $pricing->hasValue('product') ? $this->Html->link($pricing->product->name, ['controller' => 'Products', 'action' => 'view', $pricing->product->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Packaging') ?></th>
                    <td><?= $pricing->hasValue('packaging') ? $this->Html->link($pricing->packaging->name, ['controller' => 'Packagings', 'action' => 'view', $pricing->packaging->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($pricing->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($pricing->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($pricing->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Unit Price') ?></th>
                    <td><?= $pricing->unit_price === null ? '' : $this->Number->format($pricing->unit_price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Wholesale Price') ?></th>
                    <td><?= $pricing->wholesale_price === null ? '' : $this->Number->format($pricing->wholesale_price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Special Price') ?></th>
                    <td><?= $pricing->special_price === null ? '' : $this->Number->format($pricing->special_price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($pricing->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($pricing->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $pricing->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>