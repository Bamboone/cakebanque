<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Transaction $transaction
 */
?>
<nav class="float-left" style="max-width: 20rem;">

    <div class="list-group m-3">
        <?= $this->Form->postLink(
            __('Supprimer la transaction'),
            ['action' => 'delete', $transaction->id], ['class' => 'list-group-item list-group-item-action bg-danger text-white', 'confirm' => __('Are you sure you want to delete # {0}?', $transaction->id)]
        )
        ?>
        <?= $this->Html->link(__('Consulter la liste des transactions'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
        <?= $this->Html->link(__('Consulter la liste des comptes banquaires'), ['controller' => 'Comptes', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
        <?= $this->Html->link(__('Ajouter un nouveau compte banquaire'), ['controller' => 'Comptes', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
    </div>

</nav>

<div class="container">
    <?= $this->Form->create($transaction) ?>
    <fieldset>
        <legend><?= __('Modifier une transaction') ?></legend>
        <?php
            echo $this->Form->control('provenance');
            echo $this->Form->control('montant');
            echo $this->Form->control('type');
            echo $this->Form->control('compte_id', ['options' => $comptes, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button('Soumettre', array('class' => 'btn btn-outline-primary')) ?>
    <?= $this->Form->end() ?>
</div>
