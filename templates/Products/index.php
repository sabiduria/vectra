<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Product> $products
 */

use App\Controller\ProductsController;

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
                    <th><?= $this->Paginator->sort('Designation') ?></th>
                    <th><?= $this->Paginator->sort('Stock') ?></th>
                    <th><?= $this->Paginator->sort('Fournisseur') ?></th>
                    <th class="text-end"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $Number++ ?></td>
                    <td><?= $this->Html->image($product->image, ['style' => 'width : 100%']) ?></td>
                    <td>
                        <strong><?= h($product->name) ?> [Ref. <?= $product->reference ?>]</strong> <br>
                        Catégorie : <em><?= $product->category->name ?></em> <br>
                        Model : <em><?= $product->brand->name ?></em> <br>
                        Packaging : <em><?= $product->packaging->name ?></em>
                    </td>
                    <td>
                        <?php
                        $product_stock = ProductsController::reorderPoint($product->id);
                        $product_stock = explode('-', $product_stock);
                        ?>
                        Stock Actuel : <strong><?= $product_stock[1] ?></strong> <br>
                        Seuil de réapprovisionnement : <strong><?= $product_stock[0] ?></strong> <br>
                        Stock Min : <strong><?= $product_stock[2] ?></strong> <br>
                        Couverture du stock : <strong><?= round($product_stock[1]/2.3, 0) ?> Jours</strong> <br>
                    </td>
                    <td><?= $product->hasValue('supplier') ? $this->Html->link($product->supplier->name, ['controller' => 'Suppliers', 'action' => 'view', $product->supplier->id]) : '' ?></td>
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
