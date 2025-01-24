<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Salesitem> $salesitems
 */
$this->set('title_2', 'Salesitems');
$Number = 1;
?>
<div class="mt-3">
    <?= $this->Html->link(__('Nouveau Salesitem'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('N°') ?></th>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('product_id') ?></th>
                    <th><?= $this->Paginator->sort('sale_id') ?></th>
                    <th><?= $this->Paginator->sort('qty') ?></th>
                    <th><?= $this->Paginator->sort('packaging_id') ?></th>
                    <th><?= $this->Paginator->sort('unit_price') ?></th>
                    <th><?= $this->Paginator->sort('subtotal') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($salesitems as $salesitem): ?>
                <tr>
                    <td><?= $Number++ ?></td>
                    <td><?= $this->Number->format($salesitem->id) ?></td>
                    <td><?= $salesitem->hasValue('product') ? $this->Html->link($salesitem->product->name, ['controller' => 'Products', 'action' => 'view', $salesitem->product->id]) : '' ?></td>
                    <td><?= $salesitem->hasValue('sale') ? $this->Html->link($salesitem->sale->id, ['controller' => 'Sales', 'action' => 'view', $salesitem->sale->id]) : '' ?></td>
                    <td><?= $salesitem->qty === null ? '' : $this->Number->format($salesitem->qty) ?></td>
                    <td><?= $salesitem->hasValue('packaging') ? $this->Html->link($salesitem->packaging->name, ['controller' => 'Packagings', 'action' => 'view', $salesitem->packaging->id]) : '' ?></td>
                    <td><?= $salesitem->unit_price === null ? '' : $this->Number->format($salesitem->unit_price) ?></td>
                    <td><?= $salesitem->subtotal === null ? '' : $this->Number->format($salesitem->subtotal) ?></td>
                    <td><?= h($salesitem->created) ?></td>
                    <td><?= h($salesitem->modified) ?></td>
                    <td><?= h($salesitem->createdby) ?></td>
                    <td><?= h($salesitem->modifiedby) ?></td>
                    <td><?= h($salesitem->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Details'), ['action' => 'view', $salesitem->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Editer'), ['action' => 'edit', $salesitem->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $salesitem->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>