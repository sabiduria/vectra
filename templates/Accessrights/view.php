<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Accessright $accessright
 */
?>
<div class="row">
    <div class="column column-80">
        <div class="accessrights view content">
            <h3><?= h($accessright->id) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Profile') ?></th>
                    <td><?= $accessright->hasValue('profile') ? $this->Html->link($accessright->profile->name, ['controller' => 'Profiles', 'action' => 'view', $accessright->profile->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Resource') ?></th>
                    <td><?= $accessright->hasValue('resource') ? $this->Html->link($accessright->resource->name, ['controller' => 'Resources', 'action' => 'view', $accessright->resource->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($accessright->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($accessright->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($accessright->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($accessright->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($accessright->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('C') ?></th>
                    <td><?= $accessright->c ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('R') ?></th>
                    <td><?= $accessright->r ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('U') ?></th>
                    <td><?= $accessright->u ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('D') ?></th>
                    <td><?= $accessright->d ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('P') ?></th>
                    <td><?= $accessright->p ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('V') ?></th>
                    <td><?= $accessright->v ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $accessright->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>