<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Customer> $customers
 */
$this->set('title_2', 'Customers');
$Number = 1;
?>
<div class="mt-3">
    <?= $this->Html->link(__('Nouveau Customer'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('N°') ?></th>
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
                    <td><?= $Number++ ?></td>
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
                        <?= $this->Html->link(__('Details'), ['action' => 'view', $customer->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Editer'), ['action' => 'edit', $customer->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $customer->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>