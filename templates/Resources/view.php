<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Resource $resource
 */
 $this->set('title_2', 'Resources');
$this->set('menu_parameters', 'active open');
?>
<div class="row">
    <div class="column column-80">
        <div class="resources view content">
            <h3><?= h($resource->name) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($resource->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Generic Name') ?></th>
                    <td><?= h($resource->generic_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Icon') ?></th>
                    <td><?= h($resource->icon) ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($resource->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($resource->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($resource->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($resource->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($resource->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $resource->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Accessrights') ?></h4>
                <?php if (!empty($resource->accessrights)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Profile Id') ?></th>
                            <th><?= __('Resource Id') ?></th>
                            <th><?= __('C') ?></th>
                            <th><?= __('R') ?></th>
                            <th><?= __('U') ?></th>
                            <th><?= __('D') ?></th>
                            <th><?= __('P') ?></th>
                            <th><?= __('V') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($resource->accessrights as $accessright) : ?>
                        <tr>
                            <td><?= h($accessright->id) ?></td>
                            <td><?= h($accessright->profile_id) ?></td>
                            <td><?= h($accessright->resource_id) ?></td>
                            <td><?= h($accessright->c) ?></td>
                            <td><?= h($accessright->r) ?></td>
                            <td><?= h($accessright->u) ?></td>
                            <td><?= h($accessright->d) ?></td>
                            <td><?= h($accessright->p) ?></td>
                            <td><?= h($accessright->v) ?></td>
                            <td><?= h($accessright->created) ?></td>
                            <td><?= h($accessright->modified) ?></td>
                            <td><?= h($accessright->createdby) ?></td>
                            <td><?= h($accessright->modifiedby) ?></td>
                            <td><?= h($accessright->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('Details'), ['controller' => 'Accessrights', 'action' => 'view', $accessright->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Editer'), ['controller' => 'Accessrights', 'action' => 'edit', $accessright->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Accessrights', 'action' => 'delete', $accessright->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
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
