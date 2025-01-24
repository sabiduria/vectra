<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Payroll> $payrolls
 */
$this->set('title_2', 'Payrolls');
$Number = 1;
?>
<div class="mt-3">
    <?= $this->Html->link(__('Nouveau Payroll'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('N°') ?></th>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('salary_id') ?></th>
                    <th><?= $this->Paginator->sort('period_start') ?></th>
                    <th><?= $this->Paginator->sort('period_end') ?></th>
                    <th><?= $this->Paginator->sort('period_salary') ?></th>
                    <th><?= $this->Paginator->sort('salary_payed') ?></th>
                    <th><?= $this->Paginator->sort('deductions') ?></th>
                    <th><?= $this->Paginator->sort('bonus') ?></th>
                    <th><?= $this->Paginator->sort('totally_payed') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('createdby') ?></th>
                    <th><?= $this->Paginator->sort('modifiedby') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($payrolls as $payroll): ?>
                <tr>
                    <td><?= $Number++ ?></td>
                    <td><?= $this->Number->format($payroll->id) ?></td>
                    <td><?= $payroll->hasValue('salary') ? $this->Html->link($payroll->salary->id, ['controller' => 'Salaries', 'action' => 'view', $payroll->salary->id]) : '' ?></td>
                    <td><?= h($payroll->period_start) ?></td>
                    <td><?= h($payroll->period_end) ?></td>
                    <td><?= $payroll->period_salary === null ? '' : $this->Number->format($payroll->period_salary) ?></td>
                    <td><?= $payroll->salary_payed === null ? '' : $this->Number->format($payroll->salary_payed) ?></td>
                    <td><?= $payroll->deductions === null ? '' : $this->Number->format($payroll->deductions) ?></td>
                    <td><?= $payroll->bonus === null ? '' : $this->Number->format($payroll->bonus) ?></td>
                    <td><?= h($payroll->totally_payed) ?></td>
                    <td><?= h($payroll->created) ?></td>
                    <td><?= h($payroll->modified) ?></td>
                    <td><?= h($payroll->createdby) ?></td>
                    <td><?= h($payroll->modifiedby) ?></td>
                    <td><?= h($payroll->deleted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Details'), ['action' => 'view', $payroll->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Editer'), ['action' => 'edit', $payroll->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $payroll->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>