<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Transfer> $transfers
 */
$this->set('title_2', 'Transfers');
$Number = 1;
?>
<div class="mt-3">
    <?= $this->Html->link(__('Nouveau Transfer'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('N°') ?></th>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('reference') ?></th>
                    <th><?= $this->Paginator->sort('shop_id') ?></th>
                    <th><?= $this->Paginator->sort('receiver_id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transfers as $transfer): ?>
                <tr>
                    <td><?= $Number++ ?></td>
                    <td><?= $this->Number->format($transfer->id) ?></td>
                    <td><?= h($transfer->reference) ?></td>
                    <td><?= $transfer->hasValue('shop') ? $this->Html->link($transfer->shop->name, ['controller' => 'Shops', 'action' => 'view', $transfer->shop->id]) : '' ?></td>
                    <td><?= $transfer->receiver_id === null ? '' : $this->Number->format($transfer->receiver_id) ?></td>
                    <td><?= h($transfer->created) ?></td>
                    <td><?= h($transfer->modified) ?></td>
                    <td><?= h($transfer->createdby) ?></td>
                    <td><?= h($transfer->modifiedby) ?></td>
                    <td><?= h($transfer->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Details'), ['action' => 'view', $transfer->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Editer'), ['action' => 'edit', $transfer->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $transfer->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>