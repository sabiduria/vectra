<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\GeneralParam $generalParam
 */
 $this->set('title_2', 'Paramètres Généraux');
?>
<div class="row">
    <div class="column column-80">
        <div class="generalParams view content">
            <div class="text-end">
                <?= $this->Html->link(__('Editer'), ['action' => 'edit', $generalParam->id], ['class' => 'btn btn-primary btn-sm']) ?>
            </div>
            <hr>
            <table class="table">
                <tr>
                    <th style="width: 20%">
                        <strong><?= __('RCCM') ?></strong>
                    </th>
                    <td><?= h($generalParam->rccm) ?></td>
                </tr>
                <tr>
                    <th>
                        <strong><?= __('ID NAT') ?></strong>
                    </th>
                    <td><?= h($generalParam->idnat) ?></td>
                </tr>
                <tr>
                    <th>
                        <strong><?= __('NUMERO IMPOT') ?></strong>
                    </th>
                    <td><?= h($generalParam->impot) ?></td>
                </tr>
                <tr>
                    <th>
                        <strong><?= __('NOM DE L\'IMPRIMANTE') ?></strong>
                    </th>
                    <td><?= h($generalParam->printer_name) ?></td>
                </tr>
                <tr>
                    <th>
                        <strong><?= __('IP IMPRIMANTE') ?></strong>
                    </th>
                    <td><?= h($generalParam->printer_ip) ?></td>
                </tr>
                <tr>
                    <th>
                        <strong><?= __('TAUX DE CROISSANCE') ?></strong>
                    </th>
                    <td><?= $generalParam->growth === null ? '' : $this->Number->format($generalParam->growth) ?>%</td>
                </tr>
            </table>
        </div>
    </div>
</div>
