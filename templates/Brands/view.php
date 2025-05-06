<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Brand $brand
 */

$this->set('menu_product', 'active open');
 $this->set('title_2', 'Brands');
?>
<div class="row">
    <div class="column column-80">
        <div class="brands view content">
            <h3><?= h($brand->name) ?></h3>
            <table class="table">
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($brand->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Createdby') ?></th>
                    <td><?= h($brand->createdby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiedby') ?></th>
                    <td><?= h($brand->modifiedby) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($brand->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($brand->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($brand->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $brand->deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($brand->description)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Products') ?></h4>
                <?php if (!empty($brand->products)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Image') ?></th>
                            <th><?= __('Supplier Id') ?></th>
                            <th><?= __('Category Id') ?></th>
                            <th><?= __('Brand Id') ?></th>
                            <th><?= __('Reference') ?></th>
                            <th><?= __('Barcode') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Specifications') ?></th>
                            <th><?= __('Notes') ?></th>
                            <th><?= __('Packaging Id') ?></th>
                            <th><?= __('Annual Demand') ?></th>
                            <th><?= __('Ordering Cost') ?></th>
                            <th><?= __('Holding Cost') ?></th>
                            <th><?= __('Lead Time Days') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Createdby') ?></th>
                            <th><?= __('Modifiedby') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($brand->products as $product) : ?>
                        <tr>
                            <td><?= h($product->id) ?></td>
                            <td><?= h($product->image) ?></td>
                            <td><?= h($product->supplier_id) ?></td>
                            <td><?= h($product->category_id) ?></td>
                            <td><?= h($product->brand_id) ?></td>
                            <td><?= h($product->reference) ?></td>
                            <td><?= h($product->barcode) ?></td>
                            <td><?= h($product->name) ?></td>
                            <td><?= h($product->specifications) ?></td>
                            <td><?= h($product->notes) ?></td>
                            <td><?= h($product->packaging_id) ?></td>
                            <td><?= h($product->annual_demand) ?></td>
                            <td><?= h($product->ordering_cost) ?></td>
                            <td><?= h($product->holding_cost) ?></td>
                            <td><?= h($product->lead_time_days) ?></td>
                            <td><?= h($product->created) ?></td>
                            <td><?= h($product->modified) ?></td>
                            <td><?= h($product->createdby) ?></td>
                            <td><?= h($product->modifiedby) ?></td>
                            <td><?= h($product->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('Details'), ['controller' => 'Products', 'action' => 'view', $product->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Editer'), ['controller' => 'Products', 'action' => 'edit', $product->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Products', 'action' => 'delete', $product->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
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
