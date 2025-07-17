<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Sale> $sales
 */

use App\Controller\GeneralController;

$this->set('title_2', 'Ventes du '. date('d-m-Y'));
$Number = 1;
$this->set('menu_sales', 'active open');
?>
<div class="mt-3">
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100 TableData">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('Ref.') ?></th>
                    <th><?= $this->Paginator->sort('Client') ?></th>
                    <th><?= $this->Paginator->sort('Total') ?></th>
                    <th><?= $this->Paginator->sort('Status') ?></th>
                    <th><?= $this->Paginator->sort('Facturier') ?></th>
                    <th class="actions"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sales as $sale): ?>
                <tr>
                    <td><?= h($sale->reference) ?></td>
                    <td><?= $sale->hasValue('customer') ? $this->Html->link($sale->customer->name, ['controller' => 'Customers', 'action' => 'view', $sale->customer->id]) : '<span class="badge bg-primary3-transparent">Ordinaire</span>' ?></td>
                    <td><?= $sale->total_amount === null ? '' : $this->Number->format($sale->total_amount) ?></td>
                    <td><?= $sale->status->id == 1 ? "<span class='badge bg-warning-transparent'>En cours d'elaboration</span>" : "<span class='badge bg-success-transparent'>Validée</span>" ?></td>
                    <td><?= $sale->hasValue('user') ? $this->Html->link($sale->user->username, ['controller' => 'Users', 'action' => 'view', $sale->user->id]) : '' ?></td>
                    <td class="text-end">
                        <?= $this->Html->link(__('<i class="ri-eye-line"></i>'), ['action' => 'view', $sale->id], ['class' => 'btn btn-success btn-sm', 'escape' => false]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>

    window.setTimeout( function() {
        window.location.reload();
    }, 10000);

</script>
