<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Spoilage> $spoilages
 */
?>
<div class="mt-3">
    <?= $this->Html->link(__('New Spoilage'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']) ?>
    <h3><?= __('Spoilages') ?></h3>
    <div class="table-responsive">
        <table class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" id="datatable-buttons">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('product_id') ?></th>
                    <th><?= $this->Paginator->sort('qty') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($spoilages as $spoilage): ?>
                <tr>
                    <td><?= $this->Number->format($spoilage->id) ?></td>
                    <td><?= $spoilage->hasValue('product') ? $this->Html->link($spoilage->product->name, ['controller' => 'Products', 'action' => 'view', $spoilage->product->id]) : '' ?></td>
                    <td><?= $spoilage->qty === null ? '' : $this->Number->format($spoilage->qty) ?></td>
                    <td><?= h($spoilage->created) ?></td>
                    <td><?= h($spoilage->modified) ?></td>
                    <td><?= h($spoilage->createdby) ?></td>
                    <td><?= h($spoilage->modifiedby) ?></td>
                    <td><?= h($spoilage->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $spoilage->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $spoilage->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $spoilage->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>