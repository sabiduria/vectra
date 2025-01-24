<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Purchasesitem> $purchasesitems
 */
$this->set('title_2', 'Purchasesitems');
$Number = 1;
?>
<div class="mt-3">
    <?= $this->Html->link(__('Nouveau Purchasesitem'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('N°') ?></th>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('purchase_id') ?></th>
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
                <?php foreach ($purchasesitems as $purchasesitem): ?>
                <tr>
                    <td><?= $Number++ ?></td>
                    <td><?= $this->Number->format($purchasesitem->id) ?></td>
                    <td><?= $purchasesitem->hasValue('purchase') ? $this->Html->link($purchasesitem->purchase->id, ['controller' => 'Purchases', 'action' => 'view', $purchasesitem->purchase->id]) : '' ?></td>
                    <td><?= $purchasesitem->hasValue('product') ? $this->Html->link($purchasesitem->product->name, ['controller' => 'Products', 'action' => 'view', $purchasesitem->product->id]) : '' ?></td>
                    <td><?= $purchasesitem->qty === null ? '' : $this->Number->format($purchasesitem->qty) ?></td>
                    <td><?= h($purchasesitem->created) ?></td>
                    <td><?= h($purchasesitem->modified) ?></td>
                    <td><?= h($purchasesitem->createdby) ?></td>
                    <td><?= h($purchasesitem->modifiedby) ?></td>
                    <td><?= h($purchasesitem->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Details'), ['action' => 'view', $purchasesitem->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Editer'), ['action' => 'edit', $purchasesitem->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $purchasesitem->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>