<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Leavestype $leavestype
 */
?>
<div class="row">
    <div class="column column-80">
        <div class="leavestypes view content">
            <h3><?= h($leavestype->name) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($leavestype->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($leavestype->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($leavestype->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($leavestype->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Maxdaysperyear') ?></th>
                    <td><?= $leavestype->maxdaysperyear === null ? '' : $this->Number->format($leavestype->maxdaysperyear) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($leavestype->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($leavestype->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $leavestype->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Leaves') ?></h4>
                <?php if (!empty($leavestype->leaves)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Leavestype Id') ?></th>
                            <th><?= __('Status Id') ?></th>
                            <th><?= __('Startdate') ?></th>
                            <th><?= __('Enddate') ?></th>
                            <th><?= __('Reason') ?></th>
                            <th><?= __('Approvedby') ?></th>
                            <th><?= __('Approveddate') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($leavestype->leaves as $leave) : ?>
                        <tr>
                            <td><?= h($leave->id) ?></td>
                            <td><?= h($leave->user_id) ?></td>
                            <td><?= h($leave->leavestype_id) ?></td>
                            <td><?= h($leave->status_id) ?></td>
                            <td><?= h($leave->startdate) ?></td>
                            <td><?= h($leave->enddate) ?></td>
                            <td><?= h($leave->reason) ?></td>
                            <td><?= h($leave->approvedby) ?></td>
                            <td><?= h($leave->approveddate) ?></td>
                            <td><?= h($leave->created) ?></td>
                            <td><?= h($leave->modified) ?></td>
                            <td><?= h($leave->createdby) ?></td>
                            <td><?= h($leave->modifiedby) ?></td>
                            <td><?= h($leave->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Leaves', 'action' => 'view', $leave->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Leaves', 'action' => 'edit', $leave->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Leaves', 'action' => 'delete', $leave->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Leavesbalances') ?></h4>
                <?php if (!empty($leavestype->leavesbalances)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Leavestype Id') ?></th>
                            <th><?= __('Available Balance') ?></th>
                            <th><?= __('Balance Year') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($leavestype->leavesbalances as $leavesbalance) : ?>
                        <tr>
                            <td><?= h($leavesbalance->id) ?></td>
                            <td><?= h($leavesbalance->user_id) ?></td>
                            <td><?= h($leavesbalance->leavestype_id) ?></td>
                            <td><?= h($leavesbalance->available_balance) ?></td>
                            <td><?= h($leavesbalance->balance_year) ?></td>
                            <td><?= h($leavesbalance->created) ?></td>
                            <td><?= h($leavesbalance->modified) ?></td>
                            <td><?= h($leavesbalance->createdby) ?></td>
                            <td><?= h($leavesbalance->modifiedby) ?></td>
                            <td><?= h($leavesbalance->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Leavesbalances', 'action' => 'view', $leavesbalance->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Leavesbalances', 'action' => 'edit', $leavesbalance->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Leavesbalances', 'action' => 'delete', $leavesbalance->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
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