<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Shop> $shops
 */
$this->set('title_2', 'Shops');
?>
<div class="mt-3">
    <?= $this->Html->link(__('New Shop'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('area_id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('address') ?></th>
                    <th><?= $this->Paginator->sort('phone') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($shops as $shop): ?>
                <tr>
                    <td><?= $this->Number->format($shop->id) ?></td>
                    <td><?= $shop->hasValue('area') ? $this->Html->link($shop->area->name, ['controller' => 'Areas', 'action' => 'view', $shop->area->id]) : '' ?></td>
                    <td><?= h($shop->name) ?></td>
                    <td><?= h($shop->address) ?></td>
                    <td><?= h($shop->phone) ?></td>
                    <td><?= h($shop->created) ?></td>
                    <td><?= h($shop->modified) ?></td>
                    <td><?= h($shop->createdby) ?></td>
                    <td><?= h($shop->modifiedby) ?></td>
                    <td><?= h($shop->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $shop->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $shop->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $shop->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>