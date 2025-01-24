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
            <h3><?= h($shop->name) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Area') ?></th>
                    <td><?= $shop->hasValue('area') ? $this->Html->link($shop->area->name, ['controller' => 'Areas', 'action' => 'view', $shop->area->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($shop->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Address') ?></th>
                    <td><?= h($shop->address) ?></td>
                </tr>
                <tr>
                    <th><?= __('Phone') ?></th>
                    <td><?= h($shop->phone) ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($shop->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($shop->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($shop->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($shop->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($shop->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $shop->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Affectations') ?></h4>
                <?php if (!empty($shop->affectations)) : ?>
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
                        <?php foreach ($shop->affectations as $affectation) : ?>
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
                <h4><?= __('Related Expenses') ?></h4>
                <?php if (!empty($shop->expenses)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Shop Id') ?></th>
                            <th><?= __('Expensestype Id') ?></th>
                            <th><?= __('Amount') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($shop->expenses as $expense) : ?>
                        <tr>
                            <td><?= h($expense->id) ?></td>
                            <td><?= h($expense->shop_id) ?></td>
                            <td><?= h($expense->expensestype_id) ?></td>
                            <td><?= h($expense->amount) ?></td>
                            <td><?= h($expense->description) ?></td>
                            <td><?= h($expense->created) ?></td>
                            <td><?= h($expense->modified) ?></td>
                            <td><?= h($expense->createdby) ?></td>
                            <td><?= h($expense->modifiedby) ?></td>
                            <td><?= h($expense->deleted) ?></td>
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
            <div class="related">
                <h4><?= __('Related Stockins') ?></h4>
                <?php if (!empty($shop->stockins)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Shop Id') ?></th>
                            <th><?= __('Reference') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($shop->stockins as $stockin) : ?>
                        <tr>
                            <td><?= h($stockin->id) ?></td>
                            <td><?= h($stockin->shop_id) ?></td>
                            <td><?= h($stockin->reference) ?></td>
                            <td><?= h($stockin->created) ?></td>
                            <td><?= h($stockin->modified) ?></td>
                            <td><?= h($stockin->createdby) ?></td>
                            <td><?= h($stockin->modifiedby) ?></td>
                            <td><?= h($stockin->deleted) ?></td>
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
            <div class="related">
                <h4><?= __('Related Transfers') ?></h4>
                <?php if (!empty($shop->transfers)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Reference') ?></th>
                            <th><?= __('Shop Id') ?></th>
                            <th><?= __('Receiver Id') ?></th>
                            <th><?= __('Reason') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($shop->transfers as $transfer) : ?>
                        <tr>
                            <td><?= h($transfer->id) ?></td>
                            <td><?= h($transfer->reference) ?></td>
                            <td><?= h($transfer->shop_id) ?></td>
                            <td><?= h($transfer->receiver_id) ?></td>
                            <td><?= h($transfer->reason) ?></td>
                            <td><?= h($transfer->created) ?></td>
                            <td><?= h($transfer->modified) ?></td>
                            <td><?= h($transfer->createdby) ?></td>
                            <td><?= h($transfer->modifiedby) ?></td>
                            <td><?= h($transfer->deleted) ?></td>
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