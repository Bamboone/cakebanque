<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Message $message
 */
$loguser = $this->request->getSession()->read('Auth.User');
?>
<div class="container">
    <br>
    <div class="jumbotron">
        <h1 class="display-3"><?=__('Vous avez presque fini!')?></h1>
        <p class="lead"><?=__('Un courriel de confirmation a été envoyé à votre adresse courriel. Veuillez cliquer sur le lien présent dans ce courriel pour avoir accès aux fonctionalités du site!')?></p>
        <hr class="my-4">
        <p class="lead">
            <?= $this->Html->link(__('Renvoyer le lien de confirmation'), ['controller'=>'Users', 'action' => 'envoieEmail', $loguser['email'], $loguser['uuid']], ['class' => 'btn btn-primary btn-lg', 'role' => 'button']) ?>
        </p>
    </div>
</div>
