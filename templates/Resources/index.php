<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Resource> $resources
 */
?>
<div class="mt-3">
    <?= $this->Html->link(__('New Resource'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']) ?>
    <h3><?= __('Resources') ?></h3>
    <div class="table-responsive">
        <table class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" id="datatable-buttons">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('generic_name') ?></th>
                    <th><?= $this->Paginator->sort('icon') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resources as $resource): ?>
                <tr>
                    <td><?= $this->Number->format($resource->id) ?></td>
                    <td><?= h($resource->name) ?></td>
                    <td><?= h($resource->generic_name) ?></td>
                    <td><?= h($resource->icon) ?></td>
                    <td><?= h($resource->created) ?></td>
                    <td><?= h($resource->modified) ?></td>
                    <td><?= h($resource->createdby) ?></td>
                    <td><?= h($resource->modifiedby) ?></td>
                    <td><?= h($resource->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $resource->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $resource->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $resource->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>