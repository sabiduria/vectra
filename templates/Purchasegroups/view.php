<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Purchasegroup $purchasegroup
 */
 $this->set('title_2', 'Purchasegroups');
?>
<div class="row">
    <div class="column column-80">
        <div class="purchasegroups view content">
            <h3><?= h($purchasegroup->id) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Reference') ?></th>
                    <td><?= h($purchasegroup->reference) ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($purchasegroup->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($purchasegroup->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($purchasegroup->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($purchasegroup->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($purchasegroup->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $purchasegroup->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>