<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Supplier $supplier
 */
 $this->set('title_2', 'Fournisseurs');
?>
<div class="row">
    <div class="column column-80">
        <div class="suppliers view content">
            <div class="row">
                <div class="col-sm-9">
                    <h3><?= h($supplier->name) ?></h3>
                </div>
                <div class="col-sm-3 text-end">
                    <strong>Adresse : </strong><?= h($supplier->address) ?><br>
                    <strong>Telephone 1 : </strong><?= h($supplier->phone1) ?><br>
                    <strong>Telephone 2 : </strong><?= h($supplier->phone2) ?><br>
                    <strong>Email : </strong><?= h($supplier->email) ?><br>
                </div>
            </div>
            <hr>

            <div class="related">
                <h5><?= __('Produits') ?></h5>
                <?php if (!empty($supplier->products)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Image') ?></th>
                            <th><?= __('Categorie') ?></th>
                            <th><?= __('Reference') ?></th>
                            <th><?= __('Barcode') ?></th>
                            <th><?= __('Nom') ?></th>
                            <th><?= __('Specifications') ?></th>
                            <th><?= __('Notes') ?></th>
                            <th><?= __('Package') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($supplier->products as $product) : ?>
                        <tr>
                            <td><?= h($product->id) ?></td>
                            <td><?= h($product->image) ?></td>
                            <td><?= h($product->category_id) ?></td>
                            <td><?= h($product->reference) ?></td>
                            <td><?= h($product->barcode) ?></td>
                            <td><?= h($product->name) ?></td>
                            <td><?= h($product->specifications) ?></td>
                            <td><?= h($product->notes) ?></td>
                            <td><?= h($product->packaging_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('Details'), ['controller' => 'Products', 'action' => 'view', $product->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Editer'), ['controller' => 'Products', 'action' => 'edit', $product->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Products', 'action' => 'delete', $product->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h5><?= __('Bon de Commandes') ?></h5>
                <?php if (!empty($supplier->purchases)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Reference') ?></th>
                            <th><?= __('Qte') ?></th>
                            <th><?= __('Date de reception') ?></th>
                            <th><?= __('Date d\'emission') ?></th>
                            <th><?= __('Par') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($supplier->purchases as $purchase) : ?>
                        <tr>
                            <td><?= h($purchase->id) ?></td>
                            <td><?= h($purchase->status_id) ?></td>
                            <td><?= h($purchase->reference) ?></td>
                            <td><?= h($purchase->qty) ?></td>
                            <td><?= h($purchase->receipt_date) ?></td>
                            <td><?= h($purchase->created) ?></td>
                            <td><?= h($purchase->createdby) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('Details'), ['controller' => 'Purchases', 'action' => 'view', $purchase->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Editer'), ['controller' => 'Purchases', 'action' => 'edit', $purchase->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Purchases', 'action' => 'delete', $purchase->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
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
