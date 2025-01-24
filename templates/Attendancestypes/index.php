<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Attendancestype> $attendancestypes
 */
$this->set('title_2', 'Attendancestypes');
$Number = 1;
?>
<div class="mt-3">
    <?= $this->Html->link(__('Nouveau Attendancestype'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('N°') ?></th>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('penality') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($attendancestypes as $attendancestype): ?>
                <tr>
                    <td><?= $Number++ ?></td>
                    <td><?= $this->Number->format($attendancestype->id) ?></td>
                    <td><?= h($attendancestype->name) ?></td>
                    <td><?= $attendancestype->penality === null ? '' : $this->Number->format($attendancestype->penality) ?></td>
                    <td><?= h($attendancestype->created) ?></td>
                    <td><?= h($attendancestype->modified) ?></td>
                    <td><?= h($attendancestype->createdby) ?></td>
                    <td><?= h($attendancestype->modifiedby) ?></td>
                    <td><?= h($attendancestype->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Details'), ['action' => 'view', $attendancestype->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Editer'), ['action' => 'edit', $attendancestype->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $attendancestype->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>