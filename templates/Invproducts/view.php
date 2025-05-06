<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Invproduct $invproduct
 */
 $this->set('title_2', 'Invproducts');
$this->set('menu_stock', 'active open');
?>
<div class="row">
    <div class="column column-80">
        <div class="invproducts view content">
            <h3><?= h($invproduct->id) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Reference') ?></th>
                    <td><?= h($invproduct->reference) ?></td>
                </tr>
                <tr>
                    <th><?= __('Inventory Period') ?></th>
                    <td><?= h($invproduct->inventory_period) ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $invproduct->hasValue('user') ? $this->Html->link($invproduct->user->id, ['controller' => 'Users', 'action' => 'view', $invproduct->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $invproduct->hasValue('status') ? $this->Html->link($invproduct->status->name, ['controller' => 'Statuses', 'action' => 'view', $invproduct->status->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($invproduct->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($invproduct->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($invproduct->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Start Date') ?></th>
                    <td><?= h($invproduct->start_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('End Date') ?></th>
                    <td><?= h($invproduct->end_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($invproduct->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($invproduct->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $invproduct->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Inventories') ?></h4>
                <?php if (!empty($invproduct->inventories)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Invproduct Id') ?></th>
                            <th><?= __('Product Id') ?></th>
                            <th><?= __('Qty') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($invproduct->inventories as $inventory) : ?>
                        <tr>
                            <td><?= h($inventory->id) ?></td>
                            <td><?= h($inventory->invproduct_id) ?></td>
                            <td><?= h($inventory->product_id) ?></td>
                            <td><?= h($inventory->qty) ?></td>
                            <td><?= h($inventory->created) ?></td>
                            <td><?= h($inventory->modified) ?></td>
                            <td><?= h($inventory->createdby) ?></td>
                            <td><?= h($inventory->modifiedby) ?></td>
                            <td><?= h($inventory->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('Details'), ['controller' => 'Inventories', 'action' => 'view', $inventory->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Editer'), ['controller' => 'Inventories', 'action' => 'edit', $inventory->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Inventories', 'action' => 'delete', $inventory->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
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
