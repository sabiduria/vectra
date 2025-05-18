<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Prospection $prospection
 * @var iterable<\App\Model\Entity\Prospection> $prospections
 * @var \Cake\Collection\CollectionInterface|string[] $products
 * @var \Cake\Collection\CollectionInterface|string[] $suppliers
 * @var \Cake\Collection\CollectionInterface|string[] $packagings
 */
$this->set('title_2', 'Prospections');
$Number = 1;
$emptyText = "Veuillez selectionner";
$this->set('menu_prospection', 'active open');
?>
<div class="mt-3">
    <div class="row">
        <div class="col-sm-4">
            <?= $this->Form->create($prospection) ?>
            <div class="row gy-2">
                <div class="col-xl-12">
                    <?= $this->Form->control('product_id', ['options' => $products, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'Article']); ?>
                </div>
                <div class="col-xl-12">
                    <?= $this->Form->control('supplier_id', ['options' => $suppliers, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'Fournisseur']); ?>
                </div>
                <div class="col-xl-12">
                    <?= $this->Form->control('packaging_id', ['options' => $packagings, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'Unité']); ?>
                </div>
                <div class="col-xl-12">
                    <?= $this->Form->control('price', ['class' => 'form-control', 'label' => 'Prix']); ?>
                </div>
                <div class="col-xl-12">
                    <?= $this->Form->control('comments', ['class' => 'form-control', 'label' => 'Comments']); ?>
                </div>
            </div>
            <div class="mt-3 mb-3">
                <?= $this->Form->button(__('Enregistrer'), ['class'=>'btn btn-success']) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>

        <div class="col-sm-8">
            <div class="table-responsive">
                <table id="scroll-vertical" class="table table-bordered text-nowrap w-100 TableData">
                    <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('N°') ?></th>
                        <th><?= $this->Paginator->sort('Produit') ?></th>
                        <th><?= $this->Paginator->sort('Fournisseur') ?></th>
                        <th><?= $this->Paginator->sort('Unité') ?></th>
                        <th><?= $this->Paginator->sort('Prix') ?></th>
                        <th><?= $this->Paginator->sort('Date') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($prospections as $prospection): ?>
                        <tr>
                            <td><?= $Number++ ?></td>
                            <td><?= $prospection->product->name ?></td>
                            <td><?= $prospection->supplier->name ?></td>
                            <td><?= $prospection->packaging->name ?></td>
                            <td><?= $prospection->price === null ? '' : $this->Number->format($prospection->price) ?></td>
                            <td><?= h($prospection->created) ?></td>
                            <td class="text-end">
                                <?= $this->Html->link(__('<i class="ri-eye-line"></i>'), ['action' => 'view', $prospection->id], ['class' => 'btn btn-success btn-sm', 'escape' => false]) ?>
                                <?= $this->Html->link(__('<i class="ri-pencil-line"></i>'), ['action' => 'edit', $prospection->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                                <?= $this->Form->postLink(__('<i class="ri-delete-bin-line"></i>'), ['action' => 'delete', $prospection->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?'), 'escape' => false]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
