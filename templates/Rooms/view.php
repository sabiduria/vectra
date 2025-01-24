<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Room $room
 */
 $this->set('title_2', 'Rooms');
?>
<div class="row">
    <div class="column column-80">
        <div class="rooms view content">
            <h3><?= h($room->name) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($room->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($room->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($room->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Shop') ?></th>
                    <td><?= $room->hasValue('shop') ? $this->Html->link($room->shop->name, ['controller' => 'Shops', 'action' => 'view', $room->shop->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($room->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Capacity') ?></th>
                    <td><?= $room->capacity === null ? '' : $this->Number->format($room->capacity) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($room->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($room->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $room->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Shopstocks') ?></h4>
                <?php if (!empty($room->shopstocks)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Product Id') ?></th>
                            <th><?= __('Room Id') ?></th>
                            <th><?= __('Stock') ?></th>
                            <th><?= __('Stock Min') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($room->shopstocks as $shopstock) : ?>
                        <tr>
                            <td><?= h($shopstock->id) ?></td>
                            <td><?= h($shopstock->product_id) ?></td>
                            <td><?= h($shopstock->room_id) ?></td>
                            <td><?= h($shopstock->stock) ?></td>
                            <td><?= h($shopstock->stock_min) ?></td>
                            <td><?= h($shopstock->created) ?></td>
                            <td><?= h($shopstock->modified) ?></td>
                            <td><?= h($shopstock->createdby) ?></td>
                            <td><?= h($shopstock->modifiedby) ?></td>
                            <td><?= h($shopstock->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('Details'), ['controller' => 'Shopstocks', 'action' => 'view', $shopstock->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Editer'), ['controller' => 'Shopstocks', 'action' => 'edit', $shopstock->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Shopstocks', 'action' => 'delete', $shopstock->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
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