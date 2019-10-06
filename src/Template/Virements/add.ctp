<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Virement $virement
 */
$loguser = $this->request->getSession()->read('Auth.User');
?>
<nav class="float-left" style="max-width: 20rem;">

    <div class="list-group m-3">
        <?= $this->Html->link(__('Consulter la liste des virements'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
        <?= $this->Html->link(__('Consulter la liste des comptes banquaires'), ['controller' => 'Comptes', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
        <?= $this->Html->link(__('Ajouter un nouveau compte banquaire'), ['controller' => 'Comptes', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
    </div>

</nav>

<div class="container">
    <br>
    <?= $this->Form->create($virement) ?>
    <fieldset>
        <legend><?= __('Faire un virement') ?></legend>
        <?php
            echo $this->Form->control('compte_id', ['options' => $comptes, 'empty' => false]);
            echo $this->Form->control('email', ['label' => 'Courriel']);
            echo $this->Form->control('montant');
            echo $this->Form->control('user_id', ['value' => $loguser['id'], 'type' => 'hidden']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Soumettre'), array('class' => 'btn btn-outline-primary')) ?>
    <?= $this->Form->end() ?>
</div>
