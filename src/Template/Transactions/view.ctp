<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Transaction $transaction
 */
use Cake\I18n\Number;
?>
<nav class="float-left" style="max-width: 20rem;">

    <div class="list-group m-3">
        <?= $this->Html->link(__('Modifier la transaction'), ['action' => 'edit', $transaction->id], ['class' => 'list-group-item list-group-item-action bg-success text-white']) ?>
        <?= $this->Form->postLink(__('Supprimer la transaction'), ['action' => 'delete', $transaction->id], ['class' => 'list-group-item list-group-item-action bg-danger text-white', 'confirm' => __('Voulez-vous vraiment supprimer la transaction # {0}?', $transaction->id)]) ?>
        <?= $this->Html->link(__('Liste des transactions'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
        <?= $this->Html->link(__('Ajouter une transaction'), ['action' => 'add'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
        <?= $this->Html->link(__('Consulter la liste des comptes banquaires'), ['controller' => 'Comptes', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
        <?= $this->Html->link(__('Ajouter un nouveau compte banquaire'), ['controller' => 'Comptes', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
    </div>

</nav>
<br>
<div class="container">
    <div class="card border-primary mb-3">
        <div class="card-header"><h4>Transaction du <?= h($transaction->created) ?></h4></div>
        <div class="card-body">
            <div class="card-text float-left">
                <strong>Provenance: </strong><?= h($transaction->provenance) ?> <br>
                <strong>Montant: </strong><?= Number::currency($transaction->montant) ?> <br>
                <strong>Compte: </strong><?= h($transaction->compte->nom)?> <br>
                <strong>Type: </strong><?= h($transaction->type) ?> <br>
                <strong>Date: </strong><?= h($transaction->created) ?> <br>
            </div>
        </div>
    </div>
</div>
