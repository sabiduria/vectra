<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Transfer $transfer
 */
 $this->set('title_2', 'Transfers');
$this->set('menu_stock', 'active open');
?>
<div class="row">
    <div class="column column-80">
        <div class="transfers view content">
            <h3><?= h($transfer->id) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Reference') ?></th>
                    <td><?= h($transfer->reference) ?></td>
                </tr>
                <tr>
                    <th><?= __('Shop') ?></th>
                    <td><?= $transfer->hasValue('shop') ? $this->Html->link($transfer->shop->name, ['controller' => 'Shops', 'action' => 'view', $transfer->shop->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($transfer->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($transfer->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($transfer->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Receiver Id') ?></th>
                    <td><?= $transfer->receiver_id === null ? '' : $this->Number->format($transfer->receiver_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($transfer->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($transfer->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $transfer->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Reason') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($transfer->reason)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Transfersdetails') ?></h4>
                <?php if (!empty($transfer->transfersdetails)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Transfer Id') ?></th>
                            <th><?= __('Product Id') ?></th>
                            <th><?= __('Qty') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($transfer->transfersdetails as $transfersdetail) : ?>
                        <tr>
                            <td><?= h($transfersdetail->id) ?></td>
                            <td><?= h($transfersdetail->transfer_id) ?></td>
                            <td><?= h($transfersdetail->product_id) ?></td>
                            <td><?= h($transfersdetail->qty) ?></td>
                            <td><?= h($transfersdetail->created) ?></td>
                            <td><?= h($transfersdetail->modified) ?></td>
                            <td><?= h($transfersdetail->createdby) ?></td>
                            <td><?= h($transfersdetail->modifiedby) ?></td>
                            <td><?= h($transfersdetail->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('Details'), ['controller' => 'Transfersdetails', 'action' => 'view', $transfersdetail->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Editer'), ['controller' => 'Transfersdetails', 'action' => 'edit', $transfersdetail->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Transfersdetails', 'action' => 'delete', $transfersdetail->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
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
