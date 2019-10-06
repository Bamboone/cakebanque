<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Transaction[]|\Cake\Collection\CollectionInterface $transactions
 */
use Cake\I18n\Number;
?>
<nav class="float-left" style="max-width: 20rem;">

    <div class="list-group m-3">
        <?= $this->Html->link(__('Ajouter une transaction'), ['action' => 'add'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
        <?= $this->Html->link(__('Consulter la liste des comptes banquaires'), ['controller' => 'Comptes', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
        <?= $this->Html->link(__('Ajouter un nouveau compte banquaire'), ['controller' => 'Comptes', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
    </div>
    <br>
    <div class="card border-secondary m-3" style="max-width: 20rem;">
        <div class="card-header"><?='Trier les transactions par'?></div>
        <div class="card-body">
            <div class="list-group">
                <?= $this->Paginator->sort('provenance') ?>
                <?= $this->Paginator->sort('montant') ?>
                <?= $this->Paginator->sort('type') ?>
                <?= $this->Paginator->sort('compte_id') ?>
                <?= $this->Paginator->sort('created', 'Date de création') ?>
            </div>
        </div>
    </div>

</nav>
<br>
<div class="container">

    <h3>Transactions</h3>

    <?php foreach ($transactions as $transaction): ?>
        <div class="card border-primary mb-3">
            <div class="card-header"><h4>Transaction du <?= h($transaction->created) ?></h4></div>
            <div class="card-body">
                <div class="card-text float-left">
                    <strong>Provenance: </strong><?= h($transaction->provenance) ?> <br>
                    <strong>Montant: </strong><?= Number::currency($transaction->montant) ?> <br>
                </div>
                <div class="float-right">
                    <div class="list-group list-group-horizontal">
                        <?= $this->Html->link(__('Consulter'), ['action' => 'view', $transaction->id], ['class' => 'list-group-item list-group-item-action text-white bg-primary']) ?>
                        <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $transaction->id], ['class' => 'list-group-item list-group-item-action text-white bg-success']) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $transaction->id], ['class' => 'list-group-item list-group-item-action text-white bg-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $transaction->id)]) ?>
                    </div>
                </div>
            </div>
        </div>

    <?php endforeach; ?>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('Début')) ?>
            <?= $this->Paginator->prev('< ' . __('Précédent')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('Suivant') . ' >') ?>
            <?= $this->Paginator->last(__('Dernier') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' =>__('Page {{page}} de {{pages}}, {{current}} entrée(s) montrée(s) sur un total de {{count}}')]) ?></p>
    </div>

