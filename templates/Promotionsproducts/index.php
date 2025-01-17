<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Promotionsproduct> $promotionsproducts
 */
$this->set('title_2', 'Promotionsproducts');
?>
<div class="mt-3">
    <?= $this->Html->link(__('New Promotionsproduct'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100">
            <thead>
                <tr>
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
                        <?= $this->Html->link(__('View'), ['action' => 'view', $promotionsproduct->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $promotionsproduct->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $promotionsproduct->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>