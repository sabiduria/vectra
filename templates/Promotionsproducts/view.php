<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Promotionsproduct $promotionsproduct
 */
?>
<div class="row">
    <div class="column column-80">
        <div class="promotionsproducts view content">
            <h3><?= h($promotionsproduct->id) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Product') ?></th>
                    <td><?= $promotionsproduct->hasValue('product') ? $this->Html->link($promotionsproduct->product->name, ['controller' => 'Products', 'action' => 'view', $promotionsproduct->product->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($promotionsproduct->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($promotionsproduct->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($promotionsproduct->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Percent') ?></th>
                    <td><?= $promotionsproduct->percent === null ? '' : $this->Number->format($promotionsproduct->percent) ?></td>
                </tr>
                <tr>
                    <th><?= __('Startdate') ?></th>
                    <td><?= h($promotionsproduct->startdate) ?></td>
                </tr>
                <tr>
                    <th><?= __('Enddate') ?></th>
                    <td><?= h($promotionsproduct->enddate) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($promotionsproduct->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($promotionsproduct->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $promotionsproduct->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>