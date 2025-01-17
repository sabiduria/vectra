<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Transfersdetail $transfersdetail
 */
 $this->set('title_2', 'Transfersdetails');
?>
<div class="row">
    <div class="column column-80">
        <div class="transfersdetails view content">
            <h3><?= h($transfersdetail->id) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Transfer') ?></th>
                    <td><?= $transfersdetail->hasValue('transfer') ? $this->Html->link($transfersdetail->transfer->id, ['controller' => 'Transfers', 'action' => 'view', $transfersdetail->transfer->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Product') ?></th>
                    <td><?= $transfersdetail->hasValue('product') ? $this->Html->link($transfersdetail->product->name, ['controller' => 'Products', 'action' => 'view', $transfersdetail->product->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($transfersdetail->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($transfersdetail->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($transfersdetail->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Qty') ?></th>
                    <td><?= $transfersdetail->qty === null ? '' : $this->Number->format($transfersdetail->qty) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($transfersdetail->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($transfersdetail->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $transfersdetail->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>