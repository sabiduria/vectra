<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Affectation> $affectations
 */
$this->set('title_2', 'Affectations');
?>
<div class="mt-3">
    <?= $this->Html->link(__('Nouveau Affectation'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100">
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
                        <?= $this->Html->link(__('Details'), ['action' => 'view', $affectation->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Editer'), ['action' => 'edit', $affectation->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $affectation->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>