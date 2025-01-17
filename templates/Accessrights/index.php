<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Accessright> $accessrights
 */
?>
<div class="mt-3">
    <?= $this->Html->link(__('New Accessright'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']) ?>
    <h3><?= __('Accessrights') ?></h3>
    <div class="table-responsive">
        <table class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" id="datatable-buttons">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('profile_id') ?></th>
                    <th><?= $this->Paginator->sort('resource_id') ?></th>
                    <th><?= $this->Paginator->sort('c') ?></th>
                    <th><?= $this->Paginator->sort('r') ?></th>
                    <th><?= $this->Paginator->sort('u') ?></th>
                    <th><?= $this->Paginator->sort('d') ?></th>
                    <th><?= $this->Paginator->sort('p') ?></th>
                    <th><?= $this->Paginator->sort('v') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($accessrights as $accessright): ?>
                <tr>
                    <td><?= $this->Number->format($accessright->id) ?></td>
                    <td><?= $accessright->hasValue('profile') ? $this->Html->link($accessright->profile->name, ['controller' => 'Profiles', 'action' => 'view', $accessright->profile->id]) : '' ?></td>
                    <td><?= $accessright->hasValue('resource') ? $this->Html->link($accessright->resource->name, ['controller' => 'Resources', 'action' => 'view', $accessright->resource->id]) : '' ?></td>
                    <td><?= h($accessright->c) ?></td>
                    <td><?= h($accessright->r) ?></td>
                    <td><?= h($accessright->u) ?></td>
                    <td><?= h($accessright->d) ?></td>
                    <td><?= h($accessright->p) ?></td>
                    <td><?= h($accessright->v) ?></td>
                    <td><?= h($accessright->created) ?></td>
                    <td><?= h($accessright->modified) ?></td>
                    <td><?= h($accessright->createdby) ?></td>
                    <td><?= h($accessright->modifiedby) ?></td>
                    <td><?= h($accessright->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $accessright->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $accessright->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $accessright->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>