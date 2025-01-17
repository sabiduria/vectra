<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Attendancestype $attendancestype
 */
?>
<div class="row">
    <div class="column column-80">
        <div class="attendancestypes view content">
            <h3><?= h($attendancestype->name) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($attendancestype->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($attendancestype->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($attendancestype->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($attendancestype->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Penality') ?></th>
                    <td><?= $attendancestype->penality === null ? '' : $this->Number->format($attendancestype->penality) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($attendancestype->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($attendancestype->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $attendancestype->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Attendances') ?></h4>
                <?php if (!empty($attendancestype->attendances)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Affectation Id') ?></th>
                            <th><?= __('Attendancestype Id') ?></th>
                            <th><?= __('Check In') ?></th>
                            <th><?= __('Check Out') ?></th>
                            <th><?= __('Notes') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($attendancestype->attendances as $attendance) : ?>
                        <tr>
                            <td><?= h($attendance->id) ?></td>
                            <td><?= h($attendance->affectation_id) ?></td>
                            <td><?= h($attendance->attendancestype_id) ?></td>
                            <td><?= h($attendance->check_in) ?></td>
                            <td><?= h($attendance->check_out) ?></td>
                            <td><?= h($attendance->notes) ?></td>
                            <td><?= h($attendance->created) ?></td>
                            <td><?= h($attendance->modified) ?></td>
                            <td><?= h($attendance->createdby) ?></td>
                            <td><?= h($attendance->modifiedby) ?></td>
                            <td><?= h($attendance->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Attendances', 'action' => 'view', $attendance->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Attendances', 'action' => 'edit', $attendance->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Attendances', 'action' => 'delete', $attendance->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>