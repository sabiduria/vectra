<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Affectation $affectation
 */
 $this->set('title_2', 'Affectations');
?>
<div class="row">
    <div class="column column-80">
        <div class="affectations view content">
            <h3><?= h($affectation->id) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $affectation->hasValue('user') ? $this->Html->link($affectation->user->id, ['controller' => 'Users', 'action' => 'view', $affectation->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Profile') ?></th>
                    <td><?= $affectation->hasValue('profile') ? $this->Html->link($affectation->profile->name, ['controller' => 'Profiles', 'action' => 'view', $affectation->profile->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Shop') ?></th>
                    <td><?= $affectation->hasValue('shop') ? $this->Html->link($affectation->shop->name, ['controller' => 'Shops', 'action' => 'view', $affectation->shop->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($affectation->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($affectation->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($affectation->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($affectation->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($affectation->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Isactived') ?></th>
                    <td><?= $affectation->isactived ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $affectation->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Attendances') ?></h4>
                <?php if (!empty($affectation->attendances)) : ?>
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
                        <?php foreach ($affectation->attendances as $attendance) : ?>
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