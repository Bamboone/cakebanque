<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Message $message
 */
$loguser = $this->request->getSession()->read('Auth.User');
?>
<nav class="float-left" style="max-width: 20rem;">

    <div class="list-group m-3">
        <?= $this->Form->postLink(
            __('Supprimer le message'),
            ['action' => 'delete', $message->id], ['class' => 'list-group-item list-group-item-action bg-danger text-white', 'confirm' => __('Voulez vous vraiment supprimer le message # {0}?', $message->id)]
        )
        ?>
        <?= $this->Html->link(__('Consulter la liste des messages'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
        <?php
            echo $this->Html->link(__('Consulter la liste des utilisateurs'), ['controller' => 'Users', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']);
            echo $this->Html->link(__('Ajouter un utilisateur'), ['controller' => 'Users', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']);
        ?>

    </div>
</nav>

<div class="container">
    <br>
    <?= $this->Form->create($message) ?>
    <fieldset>
        <legend><?= __('Modifier le message') ?></legend>
        <?php
        echo $this->Form->control('titre');
        echo $this->Form->control('message', ['type'=> 'textarea']);
        echo $this->Form->control('users._ids', ['options' => $users, 'label' => 'Envoyé à']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Soumettre'), array('class' => 'btn btn-outline-primary')) ?>
    <?= $this->Form->end() ?>
</div>
