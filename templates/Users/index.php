<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\User> $users
 */
$this->set('title_2', 'Employés');
$Number = 1;
$employeeType = ['Intern' => 'Interne', 'Extern' => 'Externe'];
?>
<div class="mt-3">
    <?= $this->Html->link(__('<i class="fa-thin fa-plus"></i> Ajouter'), ['action' => 'add'], ['class' => 'btn btn-sm btn-primary-light mb-3', 'escape' => false]) ?>
    <div class="table-responsive">
        <table id="scroll-vertical" class="table table-bordered text-nowrap w-100 TableData">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('N°') ?></th>
                    <th><?= $this->Paginator->sort('Nom Complet') ?></th>
                    <th><?= $this->Paginator->sort('Adresse') ?></th>
                    <th><?= $this->Paginator->sort('Telephone 1') ?></th>
                    <th><?= $this->Paginator->sort('Telephone 2') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $Number++ ?></td>
                    <td><?= h($user->firstname) ?> <?= h($user->lastname) ?></td>
                    <td><?= h($user->address) ?></td>
                    <td><?= h($user->phone1) ?></td>
                    <td><?= h($user->phone2) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Details'), ['action' => 'view', $user->id], ['class' => 'btn btn-success btn-sm']) ?>
                        <?= $this->Html->link(__('Editer'), ['action' => 'edit', $user->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $user->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cette information ?')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
