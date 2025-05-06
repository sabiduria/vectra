<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Product> $products
 */
$this->set('menu_product', 'active open');
$this->set('title_2', 'Gestion des Articles');
$Number = 1;
?>
<div class="mt-3">
    <?= $this->Html->link(__('<i class="fa-thin fa-plus"></i> Ajouter'), ['action' => 'add'], ['class' => 'btn btn-sm btn-primary-light mb-3', 'escape' => false]) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100 TableData">
            <thead>
                <tr>
                    <th style="width: 3%"><?= $this->Paginator->sort('N°') ?></th>
                    <th style="width: 5%"><?= $this->Paginator->sort('Image') ?></th>
                    <th><?= $this->Paginator->sort('Fournisseur') ?></th>
                    <th><?= $this->Paginator->sort('Categorie') ?></th>
                    <th><?= $this->Paginator->sort('reference') ?></th>
                    <th><?= $this->Paginator->sort('Designation') ?></th>
                    <th><?= $this->Paginator->sort('Package') ?></th>
                    <th class="text-end"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $Number++ ?></td>
                    <td><?= $this->Html->image($product->image, ['style' => 'width : 100%']) ?></td>
                    <td><?= $product->hasValue('supplier') ? $this->Html->link($product->supplier->name, ['controller' => 'Suppliers', 'action' => 'view', $product->supplier->id]) : '' ?></td>
                    <td><?= $product->hasValue('category') ? $this->Html->link($product->category->name, ['controller' => 'Categories', 'action' => 'view', $product->category->id]) : '' ?></td>
                    <td><?= h($product->reference) ?></td>
                    <td><?= h($product->name) ?></td>
                    <td><?= $product->hasValue('packaging') ? $this->Html->link($product->packaging->name, ['controller' => 'Packagings', 'action' => 'view', $product->packaging->id]) : '' ?></td>
                    <td class="text-end">
                        <?= $this->Html->link(__('<i class="ri-eye-line"></i>'), ['action' => 'view', $product->id], ['class' => 'btn btn-success btn-sm', 'escape' => false]) ?>
                        <?= $this->Html->link(__('<i class="ri-pencil-line"></i>'), ['action' => 'edit', $product->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                        <?= $this->Form->postLink(__('<i class="ri-delete-bin-line"></i>'), ['action' => 'delete', $product->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?'), 'escape' => false]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
