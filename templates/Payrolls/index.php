<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Payroll> $payrolls
 */
$this->set('title_2', 'Payrolls');
$Number = 1;
?>
<div class="mt-3">
    <button class="btn btn-sm btn-primary-light mb-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#NewItem" aria-controls="NewItem"><i class="fa-thin fa-plus"></i> Ajouter</button>
    <?= $this->Html->link(__('Nouveau Payroll'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm mb-3']) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100 TableData">
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
                    <td class="text-end">
                        <?= $this->Html->link(__('<i class="ri-eye-line"></i>'), ['action' => 'view', $payroll->id], ['class' => 'btn btn-success btn-sm', 'escape' => false]) ?>
                        <?= $this->Html->link(__('<i class="ri-pencil-line"></i>'), ['action' => 'edit', $payroll->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                        <?= $this->Form->postLink(__('<i class="ri-delete-bin-line"></i>'), ['action' => 'delete', $payroll->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?'), 'escape' => false]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="NewItem"
     aria-labelledby="offcanvasRightLabel1">
    <div class="offcanvas-header border-bottom border-block-end-dashed">
        <h5 class="offcanvas-title" id="offcanvasRightLabel1">Nouveau Payrolls</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-3">
        <div class="row">
            <div id="response"></div>
<div class="mt-3">
    <?= $this->Form->create(null, ['id' => 'DataForm']);?>
        <div class="row gy-2">
            <div class="col-xl-12">
                <?= $this->Form->control('salary_id', ['options' => $salaries, 'empty' => $emptyText, 'class' => 'form-select js-example-basic-single', 'label' => 'salary_id']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('period_start', ['empty' => true, 'class' => 'form-control', 'label' => 'period_start']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('period_end', ['empty' => true, 'class' => 'form-control', 'label' => 'period_end']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('period_salary', ['class' => 'form-control', 'label' => 'period_salary']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('salary_payed', ['class' => 'form-control', 'label' => 'salary_payed']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('deductions', ['class' => 'form-control', 'label' => 'deductions']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('bonus', ['class' => 'form-control', 'label' => 'bonus']); ?>
            </div>
            <div class="col-xl-12">
                <?= $this->Form->control('totally_payed', ['class' => 'form-control', 'label' => 'totally_payed']); ?>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <?= $this->Form->button(__('Enregistrer'), ['class'=>'btn btn-success']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#DataForm').on('submit', function(e) {
            e.preventDefault(); // Prevent default form submission
            // Get form data
            var formData = $(this).serialize();

            // Perform AJAX request
            $.ajax({
                url: '<?= $this->Url->build(["controller" => 'Payrolls', 'action' => 'insert']) ?>',
                method: 'POST',
                data: formData,
                dataType: 'json', // Expecting JSON in the response
                success: function(response) {
                    console.log(response.data); // Log the JSON response
                    $('#response').html('<div class="alert alert-success rounded-pill alert-dismissible fade show mb-1 mt-2">' + response.message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="bi bi-x"></i></button> </div>'); // Show success message
                    var newRow = '<tr>';
                    newRow += '<td>'+''+'</td>'; // Add your actions
                    newRow += '</tr>';

                    // Append the new row to the table
                    $('.TableData tbody').append(newRow);
                    $('#DataForm')[0].reset();
                },
                error: function(xhr, status, error) {
                    console.error(error); // Log any error
                    $('#response').html('<p>An error occurred. Please try again.</p>');
                }
            });
        });
    });
</script>
