<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Salary $salary
 */
 $this->set('title_2', 'Salaries');
?>
<div class="row">
    <div class="column column-80">
        <div class="salaries view content">
            <h3><?= h($salary->id) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $salary->hasValue('user') ? $this->Html->link($salary->user->id, ['controller' => 'Users', 'action' => 'view', $salary->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($salary->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($salary->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($salary->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Amount') ?></th>
                    <td><?= $salary->amount === null ? '' : $this->Number->format($salary->amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($salary->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($salary->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $salary->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Payrolls') ?></h4>
                <?php if (!empty($salary->payrolls)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Salary Id') ?></th>
                            <th><?= __('Period Start') ?></th>
                            <th><?= __('Period End') ?></th>
                            <th><?= __('Period Salary') ?></th>
                            <th><?= __('Salary Payed') ?></th>
                            <th><?= __('Deductions') ?></th>
                            <th><?= __('Bonus') ?></th>
                            <th><?= __('Totally Payed') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($salary->payrolls as $payroll) : ?>
                        <tr>
                            <td><?= h($payroll->id) ?></td>
                            <td><?= h($payroll->salary_id) ?></td>
                            <td><?= h($payroll->period_start) ?></td>
                            <td><?= h($payroll->period_end) ?></td>
                            <td><?= h($payroll->period_salary) ?></td>
                            <td><?= h($payroll->salary_payed) ?></td>
                            <td><?= h($payroll->deductions) ?></td>
                            <td><?= h($payroll->bonus) ?></td>
                            <td><?= h($payroll->totally_payed) ?></td>
                            <td><?= h($payroll->created) ?></td>
                            <td><?= h($payroll->modified) ?></td>
                            <td><?= h($payroll->createdby) ?></td>
                            <td><?= h($payroll->modifiedby) ?></td>
                            <td><?= h($payroll->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Payrolls', 'action' => 'view', $payroll->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Payrolls', 'action' => 'edit', $payroll->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Payrolls', 'action' => 'delete', $payroll->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>