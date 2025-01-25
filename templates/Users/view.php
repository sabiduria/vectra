<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
 $this->set('title_2', 'Employés');
?>
<div class="row">
    <div class="column column-80">
        <div class="users view content">
            <div class="row">
                <div class="col-sm-9">
                    <h3><?= h($user->firstname) ?> <?= h($user->lastname) ?></h3>
                </div>
                <div class="col-sm-3">
                    <strong>Adresse : </strong><?= h($user->address) ?><br>
                    <strong>Telephone 1 : </strong><?= h($user->phone1) ?><br>
                    <strong>Telephone 2 : </strong><?= h($user->phone2) ?><br>
                    <strong>Type : </strong><?= h($user->employeetype) ?><br>
                    <strong>Quota congé par mois : </strong><?= h($user->leave_days_month) ?><br>
                </div>
            </div>
            <hr>

            <div class="related">
                <h5><?= __('Affectations') ?></h5>
                <?php if (!empty($user->affectations)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Profile') ?></th>
                            <th><?= __('Shop') ?></th>
                            <th><?= __('Etat') ?></th>
                            <th><?= __('Date') ?></th>
                            <th><?= __('Par') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->affectations as $affectation) : ?>
                        <tr>
                            <td><?= h($affectation->id) ?></td>
                            <td><?= h($affectation->profile_id) ?></td>
                            <td><?= h($affectation->shop_id) ?></td>
                            <td><?= h($affectation->isactived) ?></td>
                            <td><?= h($affectation->created) ?></td>
                            <td><?= h($affectation->createdby) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('Details'), ['controller' => 'Affectations', 'action' => 'view', $affectation->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Editer'), ['controller' => 'Affectations', 'action' => 'edit', $affectation->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Affectations', 'action' => 'delete', $affectation->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h5><?= __('Congés') ?></h5>
                <?php if (!empty($user->leaves)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Type') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Date Debut') ?></th>
                            <th><?= __('Date Fin') ?></th>
                            <th><?= __('Raison') ?></th>
                            <th><?= __('Approuvé par') ?></th>
                            <th><?= __('Date approbation') ?></th>
                            <th><?= __('Date soumission') ?></th>
                            <th><?= __('Par') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->leaves as $leave) : ?>
                        <tr>
                            <td><?= h($leave->id) ?></td>
                            <td><?= h($leave->leavestype_id) ?></td>
                            <td><?= h($leave->status_id) ?></td>
                            <td><?= h($leave->startdate) ?></td>
                            <td><?= h($leave->enddate) ?></td>
                            <td><?= h($leave->reason) ?></td>
                            <td><?= h($leave->approvedby) ?></td>
                            <td><?= h($leave->approveddate) ?></td>
                            <td><?= h($leave->created) ?></td>
                            <td><?= h($leave->createdby) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('Details'), ['controller' => 'Leaves', 'action' => 'view', $leave->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Editer'), ['controller' => 'Leaves', 'action' => 'edit', $leave->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Leaves', 'action' => 'delete', $leave->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h5><?= __('Balances Congés') ?></h5>
                <?php if (!empty($user->leavesbalances)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Type') ?></th>
                            <th><?= __('Balance') ?></th>
                            <th><?= __('Année') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->leavesbalances as $leavesbalance) : ?>
                        <tr>
                            <td><?= h($leavesbalance->id) ?></td>
                            <td><?= h($leavesbalance->leavestype_id) ?></td>
                            <td><?= h($leavesbalance->available_balance) ?></td>
                            <td><?= h($leavesbalance->balance_year) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('Details'), ['controller' => 'Leavesbalances', 'action' => 'view', $leavesbalance->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Editer'), ['controller' => 'Leavesbalances', 'action' => 'edit', $leavesbalance->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Leavesbalances', 'action' => 'delete', $leavesbalance->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h5><?= __('Salaires') ?></h5>
                <?php if (!empty($user->salaries)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Salaire Net') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->salaries as $salary) : ?>
                        <tr>
                            <td><?= h($salary->id) ?></td>
                            <td><?= h($salary->amount) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('Details'), ['controller' => 'Salaries', 'action' => 'view', $salary->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Editer'), ['controller' => 'Salaries', 'action' => 'edit', $salary->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Salaries', 'action' => 'delete', $salary->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h5><?= __('Ventes') ?></h5>
                <?php if (!empty($user->sales)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Client') ?></th>
                            <th><?= __('Reference') ?></th>
                            <th><?= __('Total') ?></th>
                            <th><?= __('Moyen de paiement') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Date') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->sales as $sale) : ?>
                        <tr>
                            <td><?= h($sale->id) ?></td>
                            <td><?= h($sale->customer_id) ?></td>
                            <td><?= h($sale->reference) ?></td>
                            <td><?= h($sale->total_amount) ?></td>
                            <td><?= h($sale->payment_method) ?></td>
                            <td><?= h($sale->status_id) ?></td>
                            <td><?= h($sale->created) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('Details'), ['controller' => 'Sales', 'action' => 'view', $sale->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Editer'), ['controller' => 'Sales', 'action' => 'edit', $sale->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Sales', 'action' => 'delete', $sale->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
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
