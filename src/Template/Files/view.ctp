<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\File $file
 */
use Cake\I18n\Number;
?>
<nav class="float-left" style="max-width: 20rem;">

    <div class="list-group m-3">
        <?= $this->Html->link(__('Modifier le fichier'), ['action' => 'edit', $file->id], ['class' => 'list-group-item list-group-item-action bg-success text-white']) ?>
        <?= $this->Form->postLink(__('Supprimer le fichier'), ['action' => 'delete', $file->id], ['class' => 'list-group-item list-group-item-action bg-danger text-white', 'confirm' => __('Voulez-vous vraiment supprimer le fichier # {0}?', $file->id)]) ?>
        <?= $this->Html->link(__('Liste des fichiers'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
        <?= $this->Html->link(__('Nouveau fichier'), ['action' => 'add'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
        <?= $this->Html->link(__('Liste des comptes banquaires'), ['controller' => 'Comptes', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
        <?= $this->Html->link(__('Nouveau compte banquaire'), ['controller' => 'Comptes', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>


    </div>

</nav>
<div class="container">
    <br>
    <div class="card border-primary mb-3">
        <div class="card-header"><h4><?= h($file->name) ?></h4></div>
        <div class="card-body">
            <div class="card-text float-left">
                <strong><?=__('Chemin')?>: </strong><?= h($file->path) ?><br>
                <strong><?=__('Date de création')?>: </strong><?= h($file->created) ?><br>
                <hr>
                <h5><?= __('Comptes reliés') ?></h5>
                <?php if (!empty($file->comptes)): ?>
                    <?php foreach ($file->comptes as $compte): ?>
                        <strong><?=__('Nom de compte') ?>: </strong><?= h($compte->nom) ?> <br>
                        <strong><?=__('Type de compte') ?>: </strong><?= h($compte->type_compte) ?> <br>
                        <strong><?=__('Balance') ?>: </strong><?= Number::currency(h($compte->balance), null, ['places' => 2]) ?> <br>
                <div class="list-group list-group-horizontal m-3">
                        <?= $this->Html->link(__('Consulter'), ['controller' => 'Comptes', 'action' => 'view', $compte->id], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
                        <?= $this->Html->link(__('Modifier'), ['controller' => 'Comptes', 'action' => 'edit', $compte->id], ['class' => 'list-group-item list-group-item-action bg-success text-white']) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Comptes', 'action' => 'delete', $compte->id], ['class' => 'list-group-item list-group-item-action bg-danger text-white', 'confirm' => __('Are you sure you want to delete # {0}?', $compte->id)]) ?>
                </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>
