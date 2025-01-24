<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Stockinsdetail> $stockinsdetails
 */
$this->set('title_2', 'Stockinsdetails');
$Number = 1;
?>
<div class="mt-3">
    <?= $this->Html->link(__('Nouveau Stockinsdetail'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('N°') ?></th>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('product_id') ?></th>
                    <th><?= $this->Paginator->sort('stockin_id') ?></th>
                    <th><?= $this->Paginator->sort('purchase_price') ?></th>
                    <th><?= $this->Paginator->sort('barcode') ?></th>
                    <th><?= $this->Paginator->sort('qty') ?></th>
                    <th><?= $this->Paginator->sort('expiry_date') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($stockinsdetails as $stockinsdetail): ?>
                <tr>
                    <td><?= $Number++ ?></td>
                    <td><?= $this->Number->format($stockinsdetail->id) ?></td>
                    <td><?= $stockinsdetail->hasValue('product') ? $this->Html->link($stockinsdetail->product->name, ['controller' => 'Products', 'action' => 'view', $stockinsdetail->product->id]) : '' ?></td>
                    <td><?= $stockinsdetail->hasValue('stockin') ? $this->Html->link($stockinsdetail->stockin->id, ['controller' => 'Stockins', 'action' => 'view', $stockinsdetail->stockin->id]) : '' ?></td>
                    <td><?= $stockinsdetail->purchase_price === null ? '' : $this->Number->format($stockinsdetail->purchase_price) ?></td>
                    <td><?= h($stockinsdetail->barcode) ?></td>
                    <td><?= $stockinsdetail->qty === null ? '' : $this->Number->format($stockinsdetail->qty) ?></td>
                    <td><?= h($stockinsdetail->expiry_date) ?></td>
                    <td><?= h($stockinsdetail->created) ?></td>
                    <td><?= h($stockinsdetail->modified) ?></td>
                    <td><?= h($stockinsdetail->createdby) ?></td>
                    <td><?= h($stockinsdetail->modifiedby) ?></td>
                    <td><?= h($stockinsdetail->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Details'), ['action' => 'view', $stockinsdetail->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Editer'), ['action' => 'edit', $stockinsdetail->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $stockinsdetail->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>