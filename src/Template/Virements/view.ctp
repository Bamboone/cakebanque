<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Virement $virement
 */

use Cake\I18n\Number;
$loguser = $this->request->getSession()->read('Auth.User');
?>
<nav class="float-left" style="max-width: 20rem;">

    <div class="list-group m-3">
        <?php if($loguser['role'] == 'admin'): ?>
        <?= $this->Html->link(__('Modifier la virement'), ['action' => 'edit', $virement->id], ['class' => 'list-group-item list-group-item-action bg-success text-white']) ?>
        <?= $this->Form->postLink(__('Supprimer la virement'), ['action' => 'delete', $virement->id], ['class' => 'list-group-item list-group-item-action bg-danger text-white', 'confirm' => __('Voulez-vous vraiment supprimer la virement # {0}?', $virement->id)]) ?>
        <?php endif; ?>
        <?= $this->Html->link(__('Liste des virements'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
        <?= $this->Html->link(__('Ajouter une virement'), ['action' => 'add'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
        <?= $this->Html->link(__('Consulter la liste des comptes banquaires'), ['controller' => 'Comptes', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
        <?= $this->Html->link(__('Ajouter un nouveau compte banquaire'), ['controller' => 'Comptes', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
    </div>

</nav>
<br>
<div class="container">
    <div class="card border-primary mb-3">
        <div class="card-header"><h4>Virement de <?= h($virement->user->name) ?></h4></div>
        <div class="card-body">
            <div class="card-text float-left">
                <strong>Envoyé à: </strong><?= h($virement->email) ?> <br>
                <strong>Montant: </strong><?= Number::currency($virement->montant) ?> <br>
                <strong>À partir du compte: </strong><?= h($virement->compte->nom) ?>
            </div>
        </div>
    </div>
</div>
