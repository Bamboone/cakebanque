<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\File[]|\Cake\Collection\CollectionInterface $files
 */
?>
<nav class="float-left" style="max-width: 20rem;">

    <div class="list-group m-3">
        <?= $this->Html->link(__('Nouveau fichier'), ['action' => 'add'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
        <?= $this->Html->link(__('Liste des comptes banquaires'), ['controller' => 'Comptes', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
        <?= $this->Html->link(__('Nouveau compte banquaire'), ['controller' => 'Comptes', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
    </div>
    <div class="card border-secondary m-3" style="max-width: 20rem;">
        <div class="card-header"><?=__('Trier les fichiers par')?></div>
        <div class="card-body">
            <div class="list-group">
                <?= $this->Paginator->sort('name') ?>
                <?= $this->Paginator->sort('path') ?>
            </div>
        </div>
    </div>


</nav>

<div class="container">
    <br>
    <h3><?= __('Fichiers') ?></h3>
    <?php foreach ($files as $file): ?>
        <div class="card border-primary mb-3">
            <div class="card-header"><h4><?= h($file->name) ?></h4></div>
            <div class="card-body">
                <div class="card-text float-left">
                    <strong><?=__('Chemin')?>: </strong><?= h($file->path) ?><br>
                </div>
                <div class="float-right">
                    <div class="list-group list-group-horizontal">
                        <?= $this->Html->link('Consulter', ['action' => 'view', $file->id], ['class' => 'list-group-item list-group-item-action text-white bg-primary']) ?>
                        <?= $this->Html->link('Modifier', ['action' => 'edit', $file->id], ['class' => 'list-group-item list-group-item-action text-white bg-success']) ?>
                        <?= $this->Form->postLink('Supprimer', ['action' => 'delete', $file->id], ['class' => 'list-group-item list-group-item-action text-white bg-danger', 'confirm' => __('Voulez vous vraiment supprimer l\'utilisateur # {0}?', $file->id)]) ?>
                    </div>
                </div>
            </div>
        </div>

    <?php endforeach; ?>

    <div>
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('Debut')) ?>
            <?= $this->Paginator->prev('< ' . __('Précédent')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('Suivant') . ' >') ?>
            <?= $this->Paginator->last(__('Dernier') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} de {{pages}}, {{current}} entrée(s) montrée(s) sur un total de {{count}}')]) ?></p>
    </div>
</div>
