<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Ordersitem> $ordersitems
 */
$this->set('title_2', 'Ordersitems');
?>
<div class="mt-3">
    <?= $this->Html->link(__('Nouveau Ordersitem'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('product_id') ?></th>
                    <th><?= $this->Paginator->sort('order_id') ?></th>
                    <th><?= $this->Paginator->sort('qty') ?></th>
                    <th><?= $this->Paginator->sort('unit_price') ?></th>
                    <th><?= $this->Paginator->sort('subtotal') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('moodifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ordersitems as $ordersitem): ?>
                <tr>
                    <td><?= $this->Number->format($ordersitem->id) ?></td>
                    <td><?= $ordersitem->hasValue('product') ? $this->Html->link($ordersitem->product->name, ['controller' => 'Products', 'action' => 'view', $ordersitem->product->id]) : '' ?></td>
                    <td><?= $ordersitem->hasValue('order') ? $this->Html->link($ordersitem->order->id, ['controller' => 'Orders', 'action' => 'view', $ordersitem->order->id]) : '' ?></td>
                    <td><?= $ordersitem->qty === null ? '' : $this->Number->format($ordersitem->qty) ?></td>
                    <td><?= $ordersitem->unit_price === null ? '' : $this->Number->format($ordersitem->unit_price) ?></td>
                    <td><?= $ordersitem->subtotal === null ? '' : $this->Number->format($ordersitem->subtotal) ?></td>
                    <td><?= h($ordersitem->created) ?></td>
                    <td><?= h($ordersitem->modified) ?></td>
                    <td><?= h($ordersitem->createdby) ?></td>
                    <td><?= h($ordersitem->moodifiedby) ?></td>
                    <td><?= h($ordersitem->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Details'), ['action' => 'view', $ordersitem->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Editer'), ['action' => 'edit', $ordersitem->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $ordersitem->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>