<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Virement $virement
 */
?>
<nav class="float-left" style="max-width: 20rem;">

    <div class="list-group m-3">
        <?= $this->Form->postLink(
            __('Supprimer le virement'),
            ['action' => 'delete', $virement->id], ['class' => 'list-group-item list-group-item-action bg-danger text-white', 'confirm' => __('Voulez-vous vraiment supprimer le virement # {0}?', $virement->id)]
        )
        ?>
        <?= $this->Html->link(__('Consulter la liste des virements'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
        <?= $this->Html->link(__('Consulter la liste des comptes banquaires'), ['controller' => 'Comptes', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
        <?= $this->Html->link(__('Ajouter un nouveau compte banquaire'), ['controller' => 'Comptes', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
    </div>

</nav>

<div class="container">
    <br>
    <?= $this->Form->create($virement) ?>
    <fieldset>
        <legend><?= __('Modifier le virement') ?></legend>
        <?php
            echo $this->Form->control('email', ['label' => 'Courriel']);
            echo $this->Form->control('montant');
            echo $this->Form->control('compte_id', ['options' => $comptes, 'empty' => true]);
            echo $this->Form->control('user_id', ['options' => $users, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Soumettre'), array('class' => 'btn btn-outline-primary')) ?>
    <?= $this->Form->end() ?>
</div>
