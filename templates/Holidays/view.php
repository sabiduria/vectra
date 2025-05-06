<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Holiday $holiday
 */
 $this->set('title_2', 'Holidays');
$this->set('menu_parameters', 'active open');
?>
<div class="row">
    <div class="column column-80">
        <div class="holidays view content">
            <h3><?= h($holiday->id) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= h($holiday->description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($holiday->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($holiday->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($holiday->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Holidaydate') ?></th>
                    <td><?= h($holiday->holidaydate) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($holiday->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($holiday->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $holiday->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
