<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Currency> $currencies
 */
$this->set('title_2', 'Currencies');
$Number = 1;
?>
<div class="mt-3">
    <?= $this->Html->link(__('Nouveau Currency'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('N°') ?></th>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('short_name') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($currencies as $currency): ?>
                <tr>
                    <td><?= $Number++ ?></td>
                    <td><?= $this->Number->format($currency->id) ?></td>
                    <td><?= h($currency->name) ?></td>
                    <td><?= h($currency->short_name) ?></td>
                    <td><?= h($currency->created) ?></td>
                    <td><?= h($currency->modified) ?></td>
                    <td><?= h($currency->createdby) ?></td>
                    <td><?= h($currency->modifiedby) ?></td>
                    <td><?= h($currency->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Details'), ['action' => 'view', $currency->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Editer'), ['action' => 'edit', $currency->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $currency->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>