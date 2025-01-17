<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Stockin> $stockins
 */
$this->set('title_2', 'Stockins');
?>
<div class="mt-3">
    <?= $this->Html->link(__('New Stockin'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('shop_id') ?></th>
                    <th><?= $this->Paginator->sort('reference') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($stockins as $stockin): ?>
                <tr>
                    <td><?= $this->Number->format($stockin->id) ?></td>
                    <td><?= $stockin->hasValue('shop') ? $this->Html->link($stockin->shop->name, ['controller' => 'Shops', 'action' => 'view', $stockin->shop->id]) : '' ?></td>
                    <td><?= h($stockin->reference) ?></td>
                    <td><?= h($stockin->created) ?></td>
                    <td><?= h($stockin->modified) ?></td>
                    <td><?= h($stockin->createdby) ?></td>
                    <td><?= h($stockin->modifiedby) ?></td>
                    <td><?= h($stockin->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $stockin->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $stockin->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $stockin->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>