<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Purchasegroup $purchasegroup
 */

use App\Controller\GeneralController;

$this->set('title_2', 'Bons d\'achats');
$this->set('menu_purchases', 'active open');
?>
<div class="row">
    <table id="scroll-vertical" class="table table-bordered text-nowrap w-100 TableData">
        <thead>
        <tr>
            <th>Reference</th>
            <th>Fournisseur</th>
            <th>Deadline</th>
            <th>Date reception</th>
            <th>Articles</th>
            <th>Qte</th>
            <th>Statut</th>
            <th>Etat de livraison</th>
            <th>Total</th>
            <th>Depenses</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($POData as $key=>$value): ?>
            <tr>
                <td><?= $value['reference'] ?></td>
                <td><?= $value['supplier'] ?></td>
                <td><?= $value['due_date'] != null ? date('Y-m-d', strtotime($value['due_date'])) : "<span class=\"badge bg-primary1\">Non indiqué</span>"  ?></td>
                <td><?= $value['receipt_date'] != null ? date('Y-m-d', strtotime($value['receipt_date'])) : "<span class=\"badge bg-secondary\">En attente</span>"  ?></td>
                <td class="text-center">
                    <span class="avatar avatar-sm avatar-rounded bg-primary">
                        <?= GeneralController::getPurchasedItems($value['id']) ?>
                    </span>
                </td>
                <td class="text-center">
                    <span class="avatar avatar-sm avatar-rounded bg-success">
                        <?= GeneralController::getPurchasedItemsQuantity($value['id']) ?>
                    </span>
                </td>
                <td class="text-center">
                    <span class="badge bg-primary-transparent"><?= $value['status'] ?></span>
                </td>
                <td>
                    <?= GeneralController::getPurchasesStatus($value['id']) ?>
                </td>
                <td>
                    <?= GeneralController::getPOAmount($value['id']) ?>
                </td>
                <td>
                    <?= GeneralController::getPOSpentAmount($value['id']) ?>
                </td>
                <td class="text-end">
                    <?php if ($value['receipt_date'] == null): ?>
                        <?= $this->Html->link(__('<i class="ri-check-double-fill"></i>'), ['controller' => 'purchases', 'action' => 'reception', $value['id']], ['class' => 'btn btn-info btn-sm', 'escape' => false]) ?>
                        <?= $this->Html->link(__('<i class="ri-calendar-check-line"></i>'), ['controller' => 'purchases', 'action' => 'edit', $value['id']], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                    <?php endif; ?>
                    <?= $this->Html->link(__('<i class="ri-eye-line"></i>'), ['controller' => 'purchases', 'action' => 'view', $value['id']], ['class' => 'btn btn-success btn-sm', 'escape' => false]) ?>
                    <?= $this->Form->postLink(__('<i class="ri-delete-bin-line"></i>'), ['controller' => 'purchases', 'action' => 'delete', $value['id']], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?'), 'escape' => false]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
