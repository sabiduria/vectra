<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Leavesbalance $leavesbalance
 */
 $this->set('title_2', 'Leavesbalances');
?>
<div class="row">
    <div class="column column-80">
        <div class="leavesbalances view content">
            <h3><?= h($leavesbalance->id) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $leavesbalance->hasValue('user') ? $this->Html->link($leavesbalance->user->id, ['controller' => 'Users', 'action' => 'view', $leavesbalance->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Leavestype') ?></th>
                    <td><?= $leavesbalance->hasValue('leavestype') ? $this->Html->link($leavesbalance->leavestype->name, ['controller' => 'Leavestypes', 'action' => 'view', $leavesbalance->leavestype->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($leavesbalance->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($leavesbalance->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($leavesbalance->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Available Balance') ?></th>
                    <td><?= $leavesbalance->available_balance === null ? '' : $this->Number->format($leavesbalance->available_balance) ?></td>
                </tr>
                <tr>
                    <th><?= __('Balance Year') ?></th>
                    <td><?= $leavesbalance->balance_year === null ? '' : $this->Number->format($leavesbalance->balance_year) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($leavesbalance->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($leavesbalance->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $leavesbalance->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>