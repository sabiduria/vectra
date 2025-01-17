<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Auditlog $auditlog
 */
?>
<div class="row">
    <div class="column column-80">
        <div class="auditlogs view content">
            <h3><?= h($auditlog->id) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Event Type') ?></th>
                    <td><?= h($auditlog->event_type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($auditlog->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($auditlog->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($auditlog->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($auditlog->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($auditlog->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $auditlog->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Event Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($auditlog->event_description)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>