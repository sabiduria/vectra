<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Attendance $attendance
 */
 $this->set('title_2', 'Attendances');
?>
<div class="row">
    <div class="column column-80">
        <div class="attendances view content">
            <h3><?= h($attendance->id) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Affectation') ?></th>
                    <td><?= $attendance->hasValue('affectation') ? $this->Html->link($attendance->affectation->id, ['controller' => 'Affectations', 'action' => 'view', $attendance->affectation->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Attendancestype') ?></th>
                    <td><?= $attendance->hasValue('attendancestype') ? $this->Html->link($attendance->attendancestype->name, ['controller' => 'Attendancestypes', 'action' => 'view', $attendance->attendancestype->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($attendance->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($attendance->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($attendance->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Check In') ?></th>
                    <td><?= h($attendance->check_in) ?></td>
                </tr>
                <tr>
                    <th><?= __('Check Out') ?></th>
                    <td><?= h($attendance->check_out) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($attendance->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($attendance->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $attendance->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Notes') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($attendance->notes)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>