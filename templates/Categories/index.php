<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Category> $categories
 */
?>
<div class="mt-3">
    <?= $this->Html->link(__('New Category'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']) ?>
    <h3><?= __('Categories') ?></h3>
    <div class="table-responsive">
        <table class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" id="datatable-buttons">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category): ?>
                <tr>
                    <td><?= $this->Number->format($category->id) ?></td>
                    <td><?= h($category->name) ?></td>
                    <td><?= h($category->created) ?></td>
                    <td><?= h($category->modified) ?></td>
                    <td><?= h($category->createdby) ?></td>
                    <td><?= h($category->modifiedby) ?></td>
                    <td><?= h($category->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $category->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $category->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $category->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>