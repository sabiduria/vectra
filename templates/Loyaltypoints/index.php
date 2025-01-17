<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Loyaltypoint> $loyaltypoints
 */
$this->set('title_2', 'Loyaltypoints');
?>
<div class="mt-3">
    <?= $this->Html->link(__('New Loyaltypoint'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('customer_id') ?></th>
                    <th><?= $this->Paginator->sort('issuedpoints') ?></th>
                    <th><?= $this->Paginator->sort('redeemedpoints') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($loyaltypoints as $loyaltypoint): ?>
                <tr>
                    <td><?= $this->Number->format($loyaltypoint->id) ?></td>
                    <td><?= $loyaltypoint->hasValue('customer') ? $this->Html->link($loyaltypoint->customer->name, ['controller' => 'Customers', 'action' => 'view', $loyaltypoint->customer->id]) : '' ?></td>
                    <td><?= $loyaltypoint->issuedpoints === null ? '' : $this->Number->format($loyaltypoint->issuedpoints) ?></td>
                    <td><?= $loyaltypoint->redeemedpoints === null ? '' : $this->Number->format($loyaltypoint->redeemedpoints) ?></td>
                    <td><?= h($loyaltypoint->created) ?></td>
                    <td><?= h($loyaltypoint->modified) ?></td>
                    <td><?= h($loyaltypoint->createdby) ?></td>
                    <td><?= h($loyaltypoint->modifiedby) ?></td>
                    <td><?= h($loyaltypoint->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $loyaltypoint->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $loyaltypoint->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $loyaltypoint->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>