<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Promotionsproduct> $promotionsproducts
 */
$this->set('title_2', 'Promotionsproducts');
$Number = 1;
?>
<div class="mt-3">
    <?= $this->Html->link(__('Nouveau Promotionsproduct'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('N°') ?></th>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('product_id') ?></th>
                    <th><?= $this->Paginator->sort('percent') ?></th>
                    <th><?= $this->Paginator->sort('startdate') ?></th>
                    <th><?= $this->Paginator->sort('enddate') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($promotionsproducts as $promotionsproduct): ?>
                <tr>
                    <td><?= $Number++ ?></td>
                    <td><?= $this->Number->format($promotionsproduct->id) ?></td>
                    <td><?= $promotionsproduct->hasValue('product') ? $this->Html->link($promotionsproduct->product->name, ['controller' => 'Products', 'action' => 'view', $promotionsproduct->product->id]) : '' ?></td>
                    <td><?= $promotionsproduct->percent === null ? '' : $this->Number->format($promotionsproduct->percent) ?></td>
                    <td><?= h($promotionsproduct->startdate) ?></td>
                    <td><?= h($promotionsproduct->enddate) ?></td>
                    <td><?= h($promotionsproduct->created) ?></td>
                    <td><?= h($promotionsproduct->modified) ?></td>
                    <td><?= h($promotionsproduct->createdby) ?></td>
                    <td><?= h($promotionsproduct->modifiedby) ?></td>
                    <td><?= h($promotionsproduct->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Details'), ['action' => 'view', $promotionsproduct->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Editer'), ['action' => 'edit', $promotionsproduct->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $promotionsproduct->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>