<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Message $message
 */
$loguser = $this->request->getSession()->read('Auth.User');
?>
<nav class="float-left" style="max-width: 20rem;">

    <div class="list-group m-3">
        <?= $this->Html->link(__('Liste des messages'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
        <?php
        if($loguser['role'] === 'admin'){
            echo $this->Html->link(__('Modifier le message'), ['action' => 'edit', $message->id], ['class' => 'list-group-item list-group-item-action bg-primary text-white']);
            echo $this->Form->postLink(__('Supprimer le message'), ['action' => 'delete', $message->id], ['class' => 'list-group-item list-group-item-action bg-danger text-white', 'confirm' => __('Voulez-vous vraiment supprimer le message # {0}?', $message->id)]);
            echo $this->Html->link(__('Écrire un message'), ['action' => 'add'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']);
            echo $this->Html->link(__('Consulter la liste des utilisateurs'), ['controller' => 'Users', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']);
            echo $this->Html->link(__('Ajouter un utilisateur'), ['controller' => 'Users', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']);
        }
        ?>

    </div>
</nav>
<div class="container">
    <div class="card border-primary mb-3 mt-3">
        <h4 class="card-header"><?= h($message->created) . ' - ' . h($message->titre) ?></h4>
        <div class="card-body">
            <div class="card-text float-left">
                <?= h($message->message) ?>
            </div>
        </div>
    </div>
</div>

