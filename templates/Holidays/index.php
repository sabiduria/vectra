<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Holiday> $holidays
 */
$this->set('title_2', 'Holidays');
?>
<div class="mt-3">
    <?= $this->Html->link(__('Nouveau Holiday'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('holidaydate') ?></th>
                    <th><?= $this->Paginator->sort('description') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($holidays as $holiday): ?>
                <tr>
                    <td><?= $this->Number->format($holiday->id) ?></td>
                    <td><?= h($holiday->holidaydate) ?></td>
                    <td><?= h($holiday->description) ?></td>
                    <td><?= h($holiday->created) ?></td>
                    <td><?= h($holiday->modified) ?></td>
                    <td><?= h($holiday->createdby) ?></td>
                    <td><?= h($holiday->modifiedby) ?></td>
                    <td><?= h($holiday->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Details'), ['action' => 'view', $holiday->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Editer'), ['action' => 'edit', $holiday->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $holiday->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>