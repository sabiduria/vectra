<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Shop $shop
 */
 $this->set('title_2', 'Shops');
?>
<div class="row">
    <div class="column column-80">
        <div class="shops view content">
            <div class="row">
                <div class="col-sm-8">
                    <h3><?= h($shop->name) ?></h3>
                </div>
                <div class="col-sm-4">
                    <table class="table table-sm">
                        <tr>
                            <th><?= __('Zone') ?></th>
                            <td><?= $shop->hasValue('area') ? $this->Html->link($shop->area->name, ['controller' => 'Areas', 'action' => 'view', $shop->area->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Adresse') ?></th>
                            <td><?= h($shop->address) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Telephone') ?></th>
                            <td><?= h($shop->phone) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <hr>

            <div class="related">
                <h6><?= __('Affectations') ?></h6>
                <?php if (!empty($shop->affectations)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Utilisateur') ?></th>
                            <th><?= __('Profile') ?></th>
                            <th><?= __('Etat') ?></th>
                            <th><?= __('Date') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($shop->affectations as $affectation) : ?>
                        <tr>
                            <td><?= h($affectation->id) ?></td>
                            <td><?= h($affectation->user_id) ?></td>
                            <td><?= h($affectation->profile_id) ?></td>
                            <td><?= h($affectation->isactived) ?></td>
                            <td><?= h($affectation->created) ?></td>
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
                <h6><?= __('Depenses') ?></h6>
                <?php if (!empty($shop->expenses)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Type') ?></th>
                            <th><?= __('Montant') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Date') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($shop->expenses as $expense) : ?>
                        <tr>
                            <td><?= h($expense->id) ?></td>
                            <td><?= h($expense->expensestype_id) ?></td>
                            <td><?= h($expense->amount) ?></td>
                            <td><?= h($expense->description) ?></td>
                            <td><?= h($expense->created) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('Details'), ['controller' => 'Expenses', 'action' => 'view', $expense->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Editer'), ['controller' => 'Expenses', 'action' => 'edit', $expense->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Expenses', 'action' => 'delete', $expense->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="related">
                        <h6><?= __('Entrées') ?></h6>
                        <?php if (!empty($shop->stockins)) : ?>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th><?= __('Id') ?></th>
                                        <th><?= __('Reference') ?></th>
                                        <th><?= __('Date') ?></th>
                                        <th class="actions"><?= __('Actions') ?></th>
                                    </tr>
                                    <?php foreach ($shop->stockins as $stockin) : ?>
                                        <tr>
                                            <td><?= h($stockin->id) ?></td>
                                            <td><?= h($stockin->reference) ?></td>
                                            <td><?= h($stockin->created) ?></td>
                                            <td class="actions">
                                                <?= $this->Html->link(__('Details'), ['controller' => 'Stockins', 'action' => 'view', $stockin->id], ['class' => 'btn btn-success btn-sm']) ?>
                                                <?= $this->Html->link(__('Editer'), ['controller' => 'Stockins', 'action' => 'edit', $stockin->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                                <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Stockins', 'action' => 'delete', $stockin->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="related">
                        <h6><?= __('Transferts') ?></h6>
                        <?php if (!empty($shop->transfers)) : ?>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th><?= __('Id') ?></th>
                                        <th><?= __('Reference') ?></th>
                                        <th><?= __('Destinataire') ?></th>
                                        <th><?= __('Raison') ?></th>
                                        <th><?= __('Date') ?></th>
                                        <th class="actions"><?= __('Actions') ?></th>
                                    </tr>
                                    <?php foreach ($shop->transfers as $transfer) : ?>
                                        <tr>
                                            <td><?= h($transfer->id) ?></td>
                                            <td><?= h($transfer->reference) ?></td>
                                            <td><?= h($transfer->receiver_id) ?></td>
                                            <td><?= h($transfer->reason) ?></td>
                                            <td><?= h($transfer->created) ?></td>
                                            <td class="actions">
                                                <?= $this->Html->link(__('Details'), ['controller' => 'Transfers', 'action' => 'view', $transfer->id], ['class' => 'btn btn-success btn-sm']) ?>
                                                <?= $this->Html->link(__('Editer'), ['controller' => 'Transfers', 'action' => 'edit', $transfer->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                                <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Transfers', 'action' => 'delete', $transfer->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
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
    </div>
</div>
