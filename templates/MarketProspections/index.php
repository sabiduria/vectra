<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\MarketProspection> $marketProspections
 */
$this->set('title_2', 'Market Prospections');
$Number = 1;
$this->set('menu_prospection', 'active open');
$emptyText = "Veuillez selectionner";
?>
<div class="mt-3">
    <div class="row">
        <div class="col-sm-4">
            <?= $this->Form->create($marketProspection) ?>
            <div class="row gy-2">
                <div class="col-xl-12">
                    <?= $this->Form->control('product_id', ['options' => $products, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'Articles']); ?>
                </div>
                <div class="col-xl-12">
                    <?= $this->Form->control('vendor', ['class' => 'form-control', 'label' => 'Marchant']); ?>
                </div>
                <div class="col-xl-6">
                    <?= $this->Form->control('packaging_id', ['options' => $packagings, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'Packaging']); ?>
                </div>
                <div class="col-xl-6">
                    <?= $this->Form->control('price', ['class' => 'form-control', 'label' => 'Prix Unitaire']); ?>
                </div>
                <div class="col-xl-6">
                    <?= $this->Form->control('whole_price', ['class' => 'form-control', 'label' => 'Prix de Gros']); ?>
                </div>
                <div class="col-xl-6">
                    <?= $this->Form->control('special_price', ['class' => 'form-control', 'label' => 'Prix Special']); ?>
                </div>
                <div class="col-xl-12">
                    <?= $this->Form->control('comments', ['class' => 'form-control', 'label' => 'Commentaire']); ?>
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
                        <th><?= $this->Paginator->sort('Articles') ?></th>
                        <th><?= $this->Paginator->sort('Marchant') ?></th>
                        <th><?= $this->Paginator->sort('Prix') ?></th>
                        <th><?= $this->Paginator->sort('Date') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($marketProspections as $marketProspection): ?>
                        <tr>
                            <td><?= $marketProspection->product->name ?></td>
                            <td><?= h($marketProspection->vendor) ?></td>
                            <td>
                                <strong>Packaging :</strong> <?= $marketProspection->packaging->name ?> <br>
                                <strong>Prix Unitaire :</strong> <?= $this->Number->format($marketProspection->price) ?> <br>
                                <strong>Prix de Gros :</strong> <?= $this->Number->format($marketProspection->whole_price) ?> <br>
                                <strong>Prix Special :</strong><?= $this->Number->format($marketProspection->special_price) ?>
                            </td>
                            <td><?= h($marketProspection->created) ?></td>
                            <td class="actions">
                                <!--?= $this->Html->link(__('Details'), ['action' => 'view', $marketProspection->id], ['class' => 'btn btn-success btn-sm']) ?-->
                                <?= $this->Html->link(__('Editer'), ['action' => 'edit', $marketProspection->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $marketProspection->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
