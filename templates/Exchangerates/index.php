<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Exchangerate> $exchangerates
 */
$this->set('title_2', 'Exchangerates');
?>
<div class="mt-3">
    <?= $this->Html->link(__('Nouveau Exchangerate'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('currency_from') ?></th>
                    <th><?= $this->Paginator->sort('currency_to') ?></th>
                    <th><?= $this->Paginator->sort('rates') ?></th>
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
                <?php foreach ($exchangerates as $exchangerate): ?>
                <tr>
                    <td><?= $this->Number->format($exchangerate->id) ?></td>
                    <td><?= $exchangerate->currency_from === null ? '' : $this->Number->format($exchangerate->currency_from) ?></td>
                    <td><?= $exchangerate->currency_to === null ? '' : $this->Number->format($exchangerate->currency_to) ?></td>
                    <td><?= $exchangerate->rates === null ? '' : $this->Number->format($exchangerate->rates) ?></td>
                    <td><?= h($exchangerate->isactived) ?></td>
                    <td><?= h($exchangerate->created) ?></td>
                    <td><?= h($exchangerate->modified) ?></td>
                    <td><?= h($exchangerate->createdby) ?></td>
                    <td><?= h($exchangerate->modifiedby) ?></td>
                    <td><?= h($exchangerate->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Details'), ['action' => 'view', $exchangerate->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Editer'), ['action' => 'edit', $exchangerate->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $exchangerate->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>