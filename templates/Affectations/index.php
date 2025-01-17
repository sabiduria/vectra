<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Affectation> $affectations
 */
?>
<div class="mt-3">
    <?= $this->Html->link(__('New Affectation'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']) ?>
    <h3><?= __('Affectations') ?></h3>
    <div class="table-responsive">
        <table class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" id="datatable-buttons">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('profile_id') ?></th>
                    <th><?= $this->Paginator->sort('shop_id') ?></th>
                    <th><?= $this->Paginator->sort('isactived') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($affectations as $affectation): ?>
                <tr>
                    <td><?= $this->Number->format($affectation->id) ?></td>
                    <td><?= $affectation->hasValue('user') ? $this->Html->link($affectation->user->id, ['controller' => 'Users', 'action' => 'view', $affectation->user->id]) : '' ?></td>
                    <td><?= $affectation->hasValue('profile') ? $this->Html->link($affectation->profile->name, ['controller' => 'Profiles', 'action' => 'view', $affectation->profile->id]) : '' ?></td>
                    <td><?= $affectation->hasValue('shop') ? $this->Html->link($affectation->shop->name, ['controller' => 'Shops', 'action' => 'view', $affectation->shop->id]) : '' ?></td>
                    <td><?= h($affectation->isactived) ?></td>
                    <td><?= h($affectation->created) ?></td>
                    <td><?= h($affectation->modified) ?></td>
                    <td><?= h($affectation->createdby) ?></td>
                    <td><?= h($affectation->modifiedby) ?></td>
                    <td><?= h($affectation->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $affectation->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $affectation->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $affectation->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>