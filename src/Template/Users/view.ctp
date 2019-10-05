<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
$loguser = $this->request->getSession()->read('Auth.User');
?>
<nav class="float-left" style="max-width: 20rem;">

    <div class="list-group m-3">
        <?= $this->Html->link(__('Modifier l\'utilisateur'), ['action' => 'edit', $user->id], ['class' => 'list-group-item list-group-item-action bg-success text-white']) ?>
        <?= $this->Form->postLink(
            __('Supprimer l\'utilisateur'),
            ['action' => 'delete', $user->id], ['class' => 'list-group-item list-group-item-action bg-danger text-white', 'confirm' => __('Voulez vous vraiment supprimer l\'utilisateur # {0}?', $user->id)]
        )
        ?>
        <?php
        if($loguser['role'] === 'admin'){
            echo $this->Html->link(__('Consulter la liste des utilisateurs'), ['controller' => 'Users', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']);
            echo $this->Html->link(__('Ajouter un utilisateur'), ['controller' => 'Users', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']);
        }
        ?>
        <?= $this->Html->link(__('Consulter la liste des comptes banquaires'), ['controller' => 'Comptes', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
        <?= $this->Html->link(__('Ajouter un nouveau compte banquaire'), ['controller' => 'Comptes', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
    </div>

</nav>

<div class="container">
    <div class="card border-primary mb-3 mt-3">
        <h4 class="card-header"><?= h($user->name) ?></h4>
        <div class="card-body">
            <div class="card-text float-left">
                <strong><?=__('Nom d\'utilisateur')?>: </strong><?= h($user->username) ?> <br>
                <strong><?=__('Courriel')?>: </strong><?= h($user->email) ?> <br>
                <strong><?=__('Sexe')?>: </strong><?= h($user->sexe) ?> <br>
                <hr>
                <h5 class="card-title mt-3"><?= __('Comptes reliés')?></h5>
                <?php foreach ($user->comptes as $comptes): ?>
                <div>
                    <strong class="m-3" ><?= h($comptes->nom) ?></strong>
                    <div class="list-group list-group-horizontal m-3">
                        <?= $this->Html->link(__('Consulter'), ['controller' => 'Comptes', 'action' => 'view', $comptes->id], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
                        <?= $this->Html->link(__('Modifier'), ['controller' => 'Comptes', 'action' => 'edit', $comptes->id], ['class' => 'list-group-item list-group-item-action bg-success text-white']) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Comptes', 'action' => 'delete', $comptes->id], ['class' => 'list-group-item list-group-item-action bg-danger text-white', 'confirm' => __('Voulez vous vraiment supprimer l\'utilisateur # {0}?', $comptes->id)]) ?>
                    </div>
                </div>

                <br>


                <?php endforeach; ?>

            </div>

        </div>
    </div>
</div>

