<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Exchangerate $exchangerate
 */
 $this->set('title_2', 'Exchangerates');
?>
<div class="row">
    <div class="column column-80">
        <div class="exchangerates view content">
            <h3><?= h($exchangerate->id) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($exchangerate->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($exchangerate->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($exchangerate->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Currency From') ?></th>
                    <td><?= $exchangerate->currency_from === null ? '' : $this->Number->format($exchangerate->currency_from) ?></td>
                </tr>
                <tr>
                    <th><?= __('Currency To') ?></th>
                    <td><?= $exchangerate->currency_to === null ? '' : $this->Number->format($exchangerate->currency_to) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rates') ?></th>
                    <td><?= $exchangerate->rates === null ? '' : $this->Number->format($exchangerate->rates) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($exchangerate->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($exchangerate->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Isactived') ?></th>
                    <td><?= $exchangerate->isactived ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $exchangerate->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>