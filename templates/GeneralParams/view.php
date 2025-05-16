<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\GeneralParam $generalParam
 */
 $this->set('title_2', 'General Params');
?>
<div class="row">
    <div class="column column-80">
        <div class="generalParams view content">
            <h3><?= h($generalParam->id) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Rccm') ?></th>
                    <td><?= h($generalParam->rccm) ?></td>
                </tr>
                <tr>
                    <th><?= __('Idnat') ?></th>
                    <td><?= h($generalParam->idnat) ?></td>
                </tr>
                <tr>
                    <th><?= __('Impot') ?></th>
                    <td><?= h($generalParam->impot) ?></td>
                </tr>
                <tr>
                    <th><?= __('Printer Name') ?></th>
                    <td><?= h($generalParam->printer_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Printer Ip') ?></th>
                    <td><?= h($generalParam->printer_ip) ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($generalParam->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($generalParam->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($generalParam->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Growth') ?></th>
                    <td><?= $generalParam->growth === null ? '' : $this->Number->format($generalParam->growth) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($generalParam->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($generalParam->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $generalParam->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>