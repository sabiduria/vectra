<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <div class="column column-80">
        <div class="users view content">
            <h3><?= h($user->id) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Firstname') ?></th>
                    <td><?= h($user->firstname) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lastname') ?></th>
                    <td><?= h($user->lastname) ?></td>
                </tr>
                <tr>
                    <th><?= __('Address') ?></th>
                    <td><?= h($user->address) ?></td>
                </tr>
                <tr>
                    <th><?= __('Phone1') ?></th>
                    <td><?= h($user->phone1) ?></td>
                </tr>
                <tr>
                    <th><?= __('Phone2') ?></th>
                    <td><?= h($user->phone2) ?></td>
                </tr>
                <tr>
                    <th><?= __('Username') ?></th>
                    <td><?= h($user->username) ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($user->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($user->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($user->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Leave Days Month') ?></th>
                    <td><?= $user->leave_days_month === null ? '' : $this->Number->format($user->leave_days_month) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($user->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($user->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $user->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Affectations') ?></h4>
                <?php if (!empty($user->affectations)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Profile Id') ?></th>
                            <th><?= __('Shop Id') ?></th>
                            <th><?= __('Isactived') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->affectations as $affectation) : ?>
                        <tr>
                            <td><?= h($affectation->id) ?></td>
                            <td><?= h($affectation->user_id) ?></td>
                            <td><?= h($affectation->profile_id) ?></td>
                            <td><?= h($affectation->shop_id) ?></td>
                            <td><?= h($affectation->isactived) ?></td>
                            <td><?= h($affectation->created) ?></td>
                            <td><?= h($affectation->modified) ?></td>
                            <td><?= h($affectation->createdby) ?></td>
                            <td><?= h($affectation->modifiedby) ?></td>
                            <td><?= h($affectation->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Affectations', 'action' => 'view', $affectation->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Affectations', 'action' => 'edit', $affectation->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Affectations', 'action' => 'delete', $affectation->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Leaves') ?></h4>
                <?php if (!empty($user->leaves)) : ?>
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
                        <?php foreach ($user->leaves as $leave) : ?>
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
                <?php if (!empty($user->leavesbalances)) : ?>
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
                        <?php foreach ($user->leavesbalances as $leavesbalance) : ?>
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
            <div class="related">
                <h4><?= __('Related Salaries') ?></h4>
                <?php if (!empty($user->salaries)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Amount') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->salaries as $salary) : ?>
                        <tr>
                            <td><?= h($salary->id) ?></td>
                            <td><?= h($salary->user_id) ?></td>
                            <td><?= h($salary->amount) ?></td>
                            <td><?= h($salary->created) ?></td>
                            <td><?= h($salary->modified) ?></td>
                            <td><?= h($salary->createdby) ?></td>
                            <td><?= h($salary->modifiedby) ?></td>
                            <td><?= h($salary->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Salaries', 'action' => 'view', $salary->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Salaries', 'action' => 'edit', $salary->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Salaries', 'action' => 'delete', $salary->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Sales') ?></h4>
                <?php if (!empty($user->sales)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Customer Id') ?></th>
                            <th><?= __('Reference') ?></th>
                            <th><?= __('Total Amount') ?></th>
                            <th><?= __('Payment Method') ?></th>
                            <th><?= __('Status Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->sales as $sale) : ?>
                        <tr>
                            <td><?= h($sale->id) ?></td>
                            <td><?= h($sale->user_id) ?></td>
                            <td><?= h($sale->customer_id) ?></td>
                            <td><?= h($sale->reference) ?></td>
                            <td><?= h($sale->total_amount) ?></td>
                            <td><?= h($sale->payment_method) ?></td>
                            <td><?= h($sale->status_id) ?></td>
                            <td><?= h($sale->created) ?></td>
                            <td><?= h($sale->modified) ?></td>
                            <td><?= h($sale->createdby) ?></td>
                            <td><?= h($sale->modifiedby) ?></td>
                            <td><?= h($sale->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Sales', 'action' => 'view', $sale->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Sales', 'action' => 'edit', $sale->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Sales', 'action' => 'delete', $sale->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
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