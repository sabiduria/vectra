<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Area $area
 */
$this->set('title_2', 'Zones de ventes');
?>
<div class="row">
    <div class="column column-80">
        <div class="areas view content">
            <div class="row">
                <div class="col-sm-8">
                    <h3><?= h($area->name) ?></h3>
                </div>
                <div class="col-sm-4">
                    <div class="text">
                        <strong><?= __('Description') ?></strong>
                        <blockquote>
                            <?= $this->Text->autoParagraph(h($area->description)); ?>
                        </blockquote>
                    </div>
                </div>
            </div>
            <hr>

            <div class="related">
                <h6><?= __('Shops de la zone') ?></h6>
                <?php if (!empty($area->shops)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Nom') ?></th>
                            <th><?= __('Adresse') ?></th>
                            <th><?= __('Phone') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($area->shops as $shop) : ?>
                        <tr>
                            <td><?= h($shop->id) ?></td>
                            <td><?= h($shop->name) ?></td>
                            <td><?= h($shop->address) ?></td>
                            <td><?= h($shop->phone) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('Details'), ['controller' => 'Shops', 'action' => 'view', $shop->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Editer'), ['controller' => 'Shops', 'action' => 'edit', $shop->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Shops', 'action' => 'delete', $shop->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
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
