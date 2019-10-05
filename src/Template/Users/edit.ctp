<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
$loguser = $this->request->getSession()->read('Auth.User');
?>
<nav class="float-left" style="max-width: 20rem;">

    <div class="list-group m-3">
        <?= $this->Form->postLink(
                __('Supprimer l\'utilisateur'),
                ['action' => 'delete', $user->id], ['class' => 'list-group-item list-group-item-action bg-danger text-white', 'confirm' => __('Voulez vous vraiment supprimer l\'utilisateur # {0}?', $user->id)]
            )
            ?>
        <?php
        if($loguser['role'] === 'admin'){
            $this->Html->link(__('Consulter la liste des utilisateurs'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']);

        }
            echo $this->Html->link(__('Consulter la liste des comptes banquaires'), ['controller' => 'Comptes', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']);
            echo $this->Html->link(__('Ajouter un nouveau compte banquaire'), ['controller' => 'Comptes', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']);
        ?>

    </div>

</nav>
<div class="container">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Modifier un utilisateur') ?></legend>
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
