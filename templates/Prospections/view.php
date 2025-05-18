<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Prospection $prospection
 */
 $this->set('title_2', 'Prospections');
$this->set('menu_prospection', 'active open');
?>
<div class="row">
    <div class="column column-80">
        <div class="prospections view content">
            <h3><?= h($prospection->id) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Product') ?></th>
                    <td><?= $prospection->hasValue('product') ? $this->Html->link($prospection->product->name, ['controller' => 'Products', 'action' => 'view', $prospection->product->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Supplier') ?></th>
                    <td><?= $prospection->hasValue('supplier') ? $this->Html->link($prospection->supplier->name, ['controller' => 'Suppliers', 'action' => 'view', $prospection->supplier->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Packaging') ?></th>
                    <td><?= $prospection->hasValue('packaging') ? $this->Html->link($prospection->packaging->name, ['controller' => 'Packagings', 'action' => 'view', $prospection->packaging->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($prospection->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($prospection->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($prospection->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Price') ?></th>
                    <td><?= $prospection->price === null ? '' : $this->Number->format($prospection->price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($prospection->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($prospection->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $prospection->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Comments') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($prospection->comments)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
