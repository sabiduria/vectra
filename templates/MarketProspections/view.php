<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MarketProspection $marketProspection
 */
 $this->set('title_2', 'Market Prospections');
?>
<div class="row">
    <div class="column column-80">
        <div class="marketProspections view content">
            <h3><?= h($marketProspection->id) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Product') ?></th>
                    <td><?= $marketProspection->hasValue('product') ? $this->Html->link($marketProspection->product->name, ['controller' => 'Products', 'action' => 'view', $marketProspection->product->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Vendor') ?></th>
                    <td><?= h($marketProspection->vendor) ?></td>
                </tr>
                <tr>
                    <th><?= __('Packaging') ?></th>
                    <td><?= $marketProspection->hasValue('packaging') ? $this->Html->link($marketProspection->packaging->name, ['controller' => 'Packagings', 'action' => 'view', $marketProspection->packaging->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($marketProspection->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($marketProspection->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($marketProspection->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Price') ?></th>
                    <td><?= $marketProspection->price === null ? '' : $this->Number->format($marketProspection->price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($marketProspection->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($marketProspection->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $marketProspection->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Comments') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($marketProspection->comments)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>