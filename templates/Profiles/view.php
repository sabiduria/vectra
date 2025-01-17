<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Profile $profile
 */
?>
<div class="row">
    <div class="column column-80">
        <div class="profiles view content">
            <h3><?= h($profile->name) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($profile->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($profile->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($profile->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($profile->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($profile->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($profile->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $profile->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Accessrights') ?></h4>
                <?php if (!empty($profile->accessrights)) : ?>
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
                        <?php foreach ($profile->accessrights as $accessright) : ?>
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
                                <?= $this->Html->link(__('View'), ['controller' => 'Accessrights', 'action' => 'view', $accessright->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Accessrights', 'action' => 'edit', $accessright->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Accessrights', 'action' => 'delete', $accessright->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Affectations') ?></h4>
                <?php if (!empty($profile->affectations)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Profile Id') ?></th>
                            <th><?= __('Shop Id') ?></th>
                            <th><?= __('Isactived') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($profile->affectations as $affectation) : ?>
                        <tr>
                            <td><?= h($affectation->id) ?></td>
                            <td><?= h($affectation->user_id) ?></td>
                            <td><?= h($affectation->profile_id) ?></td>
                            <td><?= h($affectation->shop_id) ?></td>
                            <td><?= h($affectation->isactived) ?></td>
                            <td><?= h($affectation->created) ?></td>
                            <td><?= h($affectation->modified) ?></td>
                            <td><?= h($affectation->createdby) ?></td>
                            <td><?= h($affectation->modifiedby) ?></td>
                            <td><?= h($affectation->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Affectations', 'action' => 'view', $affectation->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Affectations', 'action' => 'edit', $affectation->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Affectations', 'action' => 'delete', $affectation->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete this record ?')]) ?>
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