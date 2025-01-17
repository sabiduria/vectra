<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Shopstock> $shopstocks
 */
$this->set('title_2', 'Shopstocks');
?>
<div class="mt-3">
    <?= $this->Html->link(__('New Shopstock'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('product_id') ?></th>
                    <th><?= $this->Paginator->sort('room_id') ?></th>
                    <th><?= $this->Paginator->sort('stock') ?></th>
                    <th><?= $this->Paginator->sort('stock_min') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($shopstocks as $shopstock): ?>
                <tr>
                    <td><?= $this->Number->format($shopstock->id) ?></td>
                    <td><?= $shopstock->hasValue('product') ? $this->Html->link($shopstock->product->name, ['controller' => 'Products', 'action' => 'view', $shopstock->product->id]) : '' ?></td>
                    <td><?= $shopstock->hasValue('room') ? $this->Html->link($shopstock->room->name, ['controller' => 'Rooms', 'action' => 'view', $shopstock->room->id]) : '' ?></td>
                    <td><?= $shopstock->stock === null ? '' : $this->Number->format($shopstock->stock) ?></td>
                    <td><?= $shopstock->stock_min === null ? '' : $this->Number->format($shopstock->stock_min) ?></td>
                    <td><?= h($shopstock->created) ?></td>
                    <td><?= h($shopstock->modified) ?></td>
                    <td><?= h($shopstock->createdby) ?></td>
                    <td><?= h($shopstock->modifiedby) ?></td>
                    <td><?= h($shopstock->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $shopstock->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $shopstock->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $shopstock->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>