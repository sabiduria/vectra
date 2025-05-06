<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Leave $leave
 */
 $this->set('title_2', 'Leaves');
$this->set('menu_attendances', 'active open');
?>
<div class="row">
    <div class="column column-80">
        <div class="leaves view content">
            <h3><?= h($leave->id) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $leave->hasValue('user') ? $this->Html->link($leave->user->id, ['controller' => 'Users', 'action' => 'view', $leave->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Leavestype') ?></th>
                    <td><?= $leave->hasValue('leavestype') ? $this->Html->link($leave->leavestype->name, ['controller' => 'Leavestypes', 'action' => 'view', $leave->leavestype->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $leave->hasValue('status') ? $this->Html->link($leave->status->name, ['controller' => 'Statuses', 'action' => 'view', $leave->status->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Approvedby') ?></th>
                    <td><?= h($leave->approvedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($leave->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($leave->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($leave->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Startdate') ?></th>
                    <td><?= h($leave->startdate) ?></td>
                </tr>
                <tr>
                    <th><?= __('Enddate') ?></th>
                    <td><?= h($leave->enddate) ?></td>
                </tr>
                <tr>
                    <th><?= __('Approveddate') ?></th>
                    <td><?= h($leave->approveddate) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($leave->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($leave->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $leave->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Reason') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($leave->reason)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
