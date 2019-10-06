<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
$loguser = $this->request->getSession()->read('Auth.User');
?>
<nav class="float-left" style="max-width: 20rem;">

    <div class="list-group m-3">
        <?php
            if($loguser){
                $this->Html->link(__('Consulter la liste des comptes banquaires'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']);
                $this->Html->link(__('Consulter la liste des utilisateurs'), ['controller' => 'Users', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']);
                $this->Html->link(__('Ajouter un nouveau compte banquaire'), ['controller' => 'Comptes', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']);

            }
        ?>
    </div>


</nav>

<div class="container">
    <br>
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Ajouter un utilisateur') ?></legend>
        <?php
            echo $this->Form->control('name', ['label' => __('Nom')]);
            echo $this->Form->control('username', ['label' => __('Nom d\'utilisateur')]);
            echo $this->Form->control('email', ['label' => __('Adresse courriel')]);
            echo $this->Form->control('password', ['label' => __('Mot de passe')]);
            echo $this->Form->control('sexe', ['label' => __('Sexe'), 'type' => 'text']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Soumettre'), array('class' => 'btn btn-outline-primary')) ?>
    <?= $this->Form->end() ?>
</div>
