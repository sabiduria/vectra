<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Spenttype $spenttype
 */
 $this->set('title_2', 'Spenttypes');
?>
<div class="row">
    <div class="column column-80">
        <div class="spenttypes view content">
            <h3><?= h($spenttype->name) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($spenttype->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($spenttype->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($spenttype->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($spenttype->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($spenttype->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($spenttype->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $spenttype->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Spents') ?></h4>
                <?php if (!empty($spenttype->spents)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Purchase Id') ?></th>
                            <th><?= __('Spenttype Id') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Amount') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($spenttype->spents as $spent) : ?>
                        <tr>
                            <td><?= h($spent->id) ?></td>
                            <td><?= h($spent->purchase_id) ?></td>
                            <td><?= h($spent->spenttype_id) ?></td>
                            <td><?= h($spent->description) ?></td>
                            <td><?= h($spent->amount) ?></td>
                            <td><?= h($spent->created) ?></td>
                            <td><?= h($spent->modified) ?></td>
                            <td><?= h($spent->createdby) ?></td>
                            <td><?= h($spent->modifiedby) ?></td>
                            <td><?= h($spent->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('Details'), ['controller' => 'Spents', 'action' => 'view', $spent->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Editer'), ['controller' => 'Spents', 'action' => 'edit', $spent->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Spents', 'action' => 'delete', $spent->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
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