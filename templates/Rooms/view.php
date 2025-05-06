<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Room $room
 */
 $this->set('title_2', 'Locaux');
$this->set('menu_warehouse', 'active open');
?>
<div class="row">
    <div class="column column-80">
        <div class="rooms view content">
            <h3><?= h($room->name) ?></h3>
            <hr>
            <div class="related">
                <h6><?= __('Produits') ?></h6>
                <?php if (!empty($room->shopstocks)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Product Id') ?></th>
                            <th><?= __('Stock') ?></th>
                            <th><?= __('Stock Min') ?></th>
                            <th><?= __('Stock Max') ?></th>
                            <th><?= __('Date') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($room->shopstocks as $shopstock) : ?>
                        <tr>
                            <td><?= h($shopstock->id) ?></td>
                            <td><?= h($shopstock->product_id) ?></td>
                            <td><?= h($shopstock->room_id) ?></td>
                            <td><?= h($shopstock->stock) ?></td>
                            <td><?= h($shopstock->stock_min) ?></td>
                            <td><?= h($shopstock->stock_max) ?></td>
                            <td><?= h($shopstock->created) ?></td>
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
