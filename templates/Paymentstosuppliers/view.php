<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Paymentstosupplier $paymentstosupplier
 */
 $this->set('title_2', 'Paymentstosuppliers');
?>
<div class="row">
    <div class="column column-80">
        <div class="paymentstosuppliers view content">
            <h3><?= h($paymentstosupplier->id) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Purchase') ?></th>
                    <td><?= $paymentstosupplier->hasValue('purchase') ? $this->Html->link($paymentstosupplier->purchase->id, ['controller' => 'Purchases', 'action' => 'view', $paymentstosupplier->purchase->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($paymentstosupplier->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($paymentstosupplier->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($paymentstosupplier->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Amount') ?></th>
                    <td><?= $paymentstosupplier->amount === null ? '' : $this->Number->format($paymentstosupplier->amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($paymentstosupplier->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($paymentstosupplier->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $paymentstosupplier->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($paymentstosupplier->description)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>