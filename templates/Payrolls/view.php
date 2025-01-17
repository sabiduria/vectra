<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Payroll $payroll
 */
 $this->set('title_2', 'Payrolls');
?>
<div class="row">
    <div class="column column-80">
        <div class="payrolls view content">
            <h3><?= h($payroll->id) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Salary') ?></th>
                    <td><?= $payroll->hasValue('salary') ? $this->Html->link($payroll->salary->id, ['controller' => 'Salaries', 'action' => 'view', $payroll->salary->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($payroll->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($payroll->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($payroll->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Period Salary') ?></th>
                    <td><?= $payroll->period_salary === null ? '' : $this->Number->format($payroll->period_salary) ?></td>
                </tr>
                <tr>
                    <th><?= __('Salary Payed') ?></th>
                    <td><?= $payroll->salary_payed === null ? '' : $this->Number->format($payroll->salary_payed) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deductions') ?></th>
                    <td><?= $payroll->deductions === null ? '' : $this->Number->format($payroll->deductions) ?></td>
                </tr>
                <tr>
                    <th><?= __('Bonus') ?></th>
                    <td><?= $payroll->bonus === null ? '' : $this->Number->format($payroll->bonus) ?></td>
                </tr>
                <tr>
                    <th><?= __('Period Start') ?></th>
                    <td><?= h($payroll->period_start) ?></td>
                </tr>
                <tr>
                    <th><?= __('Period End') ?></th>
                    <td><?= h($payroll->period_end) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($payroll->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($payroll->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Totally Payed') ?></th>
                    <td><?= $payroll->totally_payed ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $payroll->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>