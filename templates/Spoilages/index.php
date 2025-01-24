<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Spoilage> $spoilages
 */
$this->set('title_2', 'Spoilages');
$Number = 1;
?>
<div class="mt-3">
    <?= $this->Html->link(__('Nouveau Spoilage'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('N°') ?></th>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('product_id') ?></th>
                    <th><?= $this->Paginator->sort('qty') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($spoilages as $spoilage): ?>
                <tr>
                    <td><?= $Number++ ?></td>
                    <td><?= $this->Number->format($spoilage->id) ?></td>
                    <td><?= $spoilage->hasValue('product') ? $this->Html->link($spoilage->product->name, ['controller' => 'Products', 'action' => 'view', $spoilage->product->id]) : '' ?></td>
                    <td><?= $spoilage->qty === null ? '' : $this->Number->format($spoilage->qty) ?></td>
                    <td><?= h($spoilage->created) ?></td>
                    <td><?= h($spoilage->modified) ?></td>
                    <td><?= h($spoilage->createdby) ?></td>
                    <td><?= h($spoilage->modifiedby) ?></td>
                    <td><?= h($spoilage->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Details'), ['action' => 'view', $spoilage->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Editer'), ['action' => 'edit', $spoilage->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $spoilage->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>