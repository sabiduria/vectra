<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Packaging> $packagings
 */
$this->set('title_2', 'Packagings');
?>
<div class="mt-3">
    <?= $this->Html->link(__('New Packaging'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100">
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
                <?php foreach ($packagings as $packaging): ?>
                <tr>
                    <td><?= $this->Number->format($packaging->id) ?></td>
                    <td><?= h($packaging->name) ?></td>
                    <td><?= h($packaging->created) ?></td>
                    <td><?= h($packaging->modified) ?></td>
                    <td><?= h($packaging->createdby) ?></td>
                    <td><?= h($packaging->modifiedby) ?></td>
                    <td><?= h($packaging->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $packaging->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $packaging->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $packaging->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>