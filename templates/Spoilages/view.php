<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Spoilage $spoilage
 */
 $this->set('title_2', 'Spoilages');
$this->set('menu_stock', 'active open');
?>
<div class="row">
    <div class="column column-80">
        <div class="spoilages view content">
            <h3><?= h($spoilage->id) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Product') ?></th>
                    <td><?= $spoilage->hasValue('product') ? $this->Html->link($spoilage->product->name, ['controller' => 'Products', 'action' => 'view', $spoilage->product->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($spoilage->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($spoilage->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($spoilage->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Qty') ?></th>
                    <td><?= $spoilage->qty === null ? '' : $this->Number->format($spoilage->qty) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($spoilage->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($spoilage->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $spoilage->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Reason') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($spoilage->reason)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
