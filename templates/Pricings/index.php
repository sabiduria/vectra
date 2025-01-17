<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Pricing> $pricings
 */
$this->set('title_2', 'Pricings');
?>
<div class="mt-3">
    <?= $this->Html->link(__('New Pricing'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('product_id') ?></th>
                    <th><?= $this->Paginator->sort('packaging_id') ?></th>
                    <th><?= $this->Paginator->sort('unit_price') ?></th>
                    <th><?= $this->Paginator->sort('wholesale_price') ?></th>
                    <th><?= $this->Paginator->sort('special_price') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pricings as $pricing): ?>
                <tr>
                    <td><?= $this->Number->format($pricing->id) ?></td>
                    <td><?= $pricing->hasValue('product') ? $this->Html->link($pricing->product->name, ['controller' => 'Products', 'action' => 'view', $pricing->product->id]) : '' ?></td>
                    <td><?= $pricing->hasValue('packaging') ? $this->Html->link($pricing->packaging->name, ['controller' => 'Packagings', 'action' => 'view', $pricing->packaging->id]) : '' ?></td>
                    <td><?= $pricing->unit_price === null ? '' : $this->Number->format($pricing->unit_price) ?></td>
                    <td><?= $pricing->wholesale_price === null ? '' : $this->Number->format($pricing->wholesale_price) ?></td>
                    <td><?= $pricing->special_price === null ? '' : $this->Number->format($pricing->special_price) ?></td>
                    <td><?= h($pricing->created) ?></td>
                    <td><?= h($pricing->modified) ?></td>
                    <td><?= h($pricing->createdby) ?></td>
                    <td><?= h($pricing->modifiedby) ?></td>
                    <td><?= h($pricing->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $pricing->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $pricing->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $pricing->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>