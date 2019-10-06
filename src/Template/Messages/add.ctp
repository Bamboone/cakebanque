<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Message $message
 */
$loguser = $this->request->getSession()->read('Auth.User');
?>
<nav class="float-left" style="max-width: 20rem;">

    <div class="list-group m-3">
        <?php
            echo $this->Html->link(__('Consulter la liste des messages'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']);
            echo $this->Html->link(__('Consulter la liste des utilisateurs'), ['controller' => 'Users', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']);
            echo $this->Html->link(__('Ajouter un utilisateur'), ['controller' => 'Users', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']);
        ?>

    </div>
</nav>
<div class="container">
    <br>
    <?= $this->Form->create($message) ?>
    <fieldset>
        <legend><?= __('Ajouter un message') ?></legend>
        <?php
        echo $this->Form->control('titre');
        echo $this->Form->control('message', ['type'=> 'textarea']);
        echo $this->Form->control('users._ids', ['options' => $users, 'label' => 'Envoyer à']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Soumettre'), array('class' => 'btn btn-outline-primary')) ?>
    <?= $this->Form->end() ?>
</div>

