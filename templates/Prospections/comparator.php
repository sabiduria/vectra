<?php
/**
 * @var \App\View\AppView $this
 */

use App\Controller\GeneralController;

$this->set('title_2', 'Comparateur Prix');
$Number = 1;
$emptyText = "Veuillez selectionner";
$this->set('menu_prospection', 'active open');
$Comparisons = GeneralController::getPriceComparison();
?>
<div class="mt-3">
    <div class="row">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table id="scroll-vertical" class="table table-bordered text-nowrap w-100 TableData">
                    <thead>
                    <tr>
                        <th>N°</th>
                        <th>Produit</th>
                        <th>Package</th>
                        <th>Vendeur</th>
                        <th>Prix Act.</th>
                        <th>Prix Conc.</th>
                        <th>Difference</th>
                        <th>Comparaison</th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($Comparisons as $prospection): ?>
                        <tr>
                            <td><?= $Number++ ?></td>
                            <td><?= $prospection['product_name'] ?></td>
                            <td><?= $prospection['packaging_name'] ?></td>
                            <td><?= $prospection['vendor'] ?></td>
                            <td><?= $prospection['my_price'] ?></td>
                            <td><?= $prospection['competitor_price'] ?></td>
                            <td><?= $prospection['price_difference'] ?></td>
                            <td>
                                <b><?= $prospection['price_comparison'] ?></b>
                                <?php if ($prospection['price_difference'] > 0): ?>
                                    <span class="badge bg-success-transparent fs-10"><i class="ri-arrow-left-up-line"></i>+<?= $prospection['price_difference_percentage'] ?>%</span>
                                <?php elseif ($prospection['price_difference'] < 0): ?>
                                    <span class="badge bg-danger-transparent fs-10"><i class="ri-arrow-left-down-line"></i><?= $prospection['price_difference_percentage'] ?>%</span>
                                <?php else: ?>
                                    <span class="badge bg-primary-transparent fs-10"><i class="ri-check-double-line"></i><?= $prospection['price_difference_percentage'] ?>%</span>
                                <?php endif; ?>

                            </td>
                            <td class="text-end">
                                <?= $this->Html->link(__('<i class="ri-file-copy-2-line"></i>'), ['action' => 'view'], ['class' => 'btn btn-success btn-sm', 'escape' => false]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
