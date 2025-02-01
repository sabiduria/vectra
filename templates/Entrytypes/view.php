<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Entrytype $entrytype
 */
 $this->set('title_2', 'Entrytypes');
?>
<div class="row">
    <div class="column column-80">
        <div class="entrytypes view content">
            <h3><?= h($entrytype->name) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($entrytype->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($entrytype->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($entrytype->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($entrytype->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($entrytype->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($entrytype->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $entrytype->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Stockins') ?></h4>
                <?php if (!empty($entrytype->stockins)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Entrytype Id') ?></th>
                            <th><?= __('Shop Id') ?></th>
                            <th><?= __('Reference') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($entrytype->stockins as $stockin) : ?>
                        <tr>
                            <td><?= h($stockin->id) ?></td>
                            <td><?= h($stockin->entrytype_id) ?></td>
                            <td><?= h($stockin->shop_id) ?></td>
                            <td><?= h($stockin->reference) ?></td>
                            <td><?= h($stockin->created) ?></td>
                            <td><?= h($stockin->modified) ?></td>
                            <td><?= h($stockin->createdby) ?></td>
                            <td><?= h($stockin->modifiedby) ?></td>
                            <td><?= h($stockin->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('Details'), ['controller' => 'Stockins', 'action' => 'view', $stockin->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Editer'), ['controller' => 'Stockins', 'action' => 'edit', $stockin->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Stockins', 'action' => 'delete', $stockin->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
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