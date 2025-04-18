<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Spent $spent
 */
 $this->set('title_2', 'Spents');
?>
<div class="row">
    <div class="column column-80">
        <div class="spents view content">
            <h3><?= h($spent->id) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Purchase') ?></th>
                    <td><?= $spent->hasValue('purchase') ? $this->Html->link($spent->purchase->id, ['controller' => 'Purchases', 'action' => 'view', $spent->purchase->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Spenttype') ?></th>
                    <td><?= $spent->hasValue('spenttype') ? $this->Html->link($spent->spenttype->name, ['controller' => 'Spenttypes', 'action' => 'view', $spent->spenttype->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($spent->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($spent->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($spent->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Amount') ?></th>
                    <td><?= $spent->amount === null ? '' : $this->Number->format($spent->amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($spent->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($spent->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $spent->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($spent->description)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>