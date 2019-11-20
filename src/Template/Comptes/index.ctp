<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Compte[]|\Cake\Collection\CollectionInterface $comptes
 */
use Cake\I18n\Number;
$loguser = $this->request->getSession()->read('Auth.User');
?>

<nav class="float-left" style="max-width: 20rem;">

    <div class="list-group m-3">
        <?= $this->Html->link(__('Créer un nouveau compte banquaire'), ['action' => 'add'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
        <?= $this->Html->link(__('Ajouter une image de compte'), ['controller' => 'Files', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
    </div>
    <br>
    <div class="card border-secondary m-3" style="max-width: 20rem;">
        <div class="card-header"><?=__('Trier les comptes par')?></div>
        <div class="card-body">
            <div class="list-group">
                <?= $this->Paginator->sort('nom', __('Nom de compte')) ?>
                <?= $this->Paginator->sort('type_compte', __('Type de compte')) ?>
                <?= $this->Paginator->sort('created', __('Date de création')) ?>
                <?= $this->Paginator->sort('modified', __('Date de modification')) ?>
            </div>
        </div>
    </div>

</nav>
<div class="container ">
    <br>
    <h3><?=__('Comptes')?></h3>


    <?php foreach ($comptes as $compte): ?>
        <div class="card border-primary mb-3">
            <div class="card-header"><h4><?= h($compte->nom) ?></h4></div>
            <div class="card-body">
                <div class="card-text float-left">
                    <strong><?=__('Type de compte') ?>: </strong><?= h($compte->type_compte) ?> <br>
                    <strong><?=__('Balance') ?>: </strong><?= Number::currency(h($compte->balance), null, ['places' => 2]) ?> <br>
                </div>
                <div class="list-group list-group-horizontal float-right">
                    <?= $this->Html->link(__('Consulter'), ['action' => 'view', $compte->id], ['class' => 'list-group-item list-group-item-action text-white bg-primary']) ?>
                    <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $compte->id], ['class' => 'list-group-item list-group-item-action text-white bg-success']) ?>
                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $compte->id], ['class' => 'list-group-item list-group-item-action text-white bg-danger', 'confirm' => __('Voulez vous vraiment supprimer le compte # {0}?', $compte->id)]) ?>
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

