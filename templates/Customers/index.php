<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Customer> $customers
 */
?>
<div class="mt-3">
    <?= $this->Html->link(__('New Customer'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']) ?>
    <h3><?= __('Customers') ?></h3>
    <div class="table-responsive">
        <table class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" id="datatable-buttons">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('phone') ?></th>
                    <th><?= $this->Paginator->sort('marketer_id') ?></th>
                    <th><?= $this->Paginator->sort('marketer_name') ?></th>
                    <th><?= $this->Paginator->sort('username') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?= $this->Number->format($customer->id) ?></td>
                    <td><?= h($customer->name) ?></td>
                    <td><?= h($customer->phone) ?></td>
                    <td><?= $customer->marketer_id === null ? '' : $this->Number->format($customer->marketer_id) ?></td>
                    <td><?= h($customer->marketer_name) ?></td>
                    <td><?= h($customer->username) ?></td>
                    <td><?= h($customer->created) ?></td>
                    <td><?= h($customer->modified) ?></td>
                    <td><?= h($customer->createdby) ?></td>
                    <td><?= h($customer->modifiedby) ?></td>
                    <td><?= h($customer->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $customer->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $customer->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $customer->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>