<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Loyaltypoint $loyaltypoint
 */
 $this->set('title_2', 'Loyaltypoints');
?>
<div class="row">
    <div class="column column-80">
        <div class="loyaltypoints view content">
            <h3><?= h($loyaltypoint->id) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Customer') ?></th>
                    <td><?= $loyaltypoint->hasValue('customer') ? $this->Html->link($loyaltypoint->customer->name, ['controller' => 'Customers', 'action' => 'view', $loyaltypoint->customer->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($loyaltypoint->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($loyaltypoint->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($loyaltypoint->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Issuedpoints') ?></th>
                    <td><?= $loyaltypoint->issuedpoints === null ? '' : $this->Number->format($loyaltypoint->issuedpoints) ?></td>
                </tr>
                <tr>
                    <th><?= __('Redeemedpoints') ?></th>
                    <td><?= $loyaltypoint->redeemedpoints === null ? '' : $this->Number->format($loyaltypoint->redeemedpoints) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($loyaltypoint->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($loyaltypoint->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $loyaltypoint->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>