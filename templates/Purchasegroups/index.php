<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Purchasegroup> $purchasegroups
 */

use App\Controller\GeneralController;

$this->set('title_2', 'Bon d\'Achats');
$Number = 1;
?>
<div class="mt-3">
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100 TableData">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('N°') ?></th>
                    <th><?= $this->Paginator->sort('reference') ?></th>
                    <th><?= $this->Paginator->sort('shop_id') ?></th>
                    <th><?= $this->Paginator->sort('Bon d\'achats') ?></th>
                    <th><?= $this->Paginator->sort('Articles') ?></th>
                    <th><?= $this->Paginator->sort('Montant') ?></th>
                    <th><?= $this->Paginator->sort('Statut') ?></th>
                    <th><?= $this->Paginator->sort('Date') ?></th>
                    <th><?= $this->Paginator->sort('Par') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($purchasegroups as $purchasegroup): ?>
                <tr>
                    <td><?= $Number++ ?></td>
                    <td><?= h($purchasegroup->reference) ?></td>
                    <td><?= GeneralController::getNameOf($purchasegroup->shop_id, 'Shops') ?></td>
                    <td><?= GeneralController::getPurchasesNumber($purchasegroup->reference) ?> bon(s)</td>
                    <td class="text-center">
                        <span class="avatar avatar-sm avatar-rounded bg-success">
                            <?= GeneralController::getPurchasesItemsNumber($purchasegroup->reference) ?>
                        </span>
                    </td>
                    <td><?= GeneralController::getPurchasesItemsAmount($purchasegroup->reference) ?></td>
                    <td><?= GeneralController::getPurchasesGroupStatus($purchasegroup->reference) ?></td>
                    <td><?= h($purchasegroup->created) ?></td>
                    <td><?= h($purchasegroup->createdby) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('<i class="ri-eye-line"></i>'), ['action' => 'view', $purchasegroup->reference], ['class' => 'btn btn-success btn-sm', 'escape' => false]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
