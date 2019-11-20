<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Compte $compte
 */
$loguser = $this->request->getSession()->read('Auth.User');
$urlToLinkedListFilter = $this->Url->build([
    "controller" => "Institutions",
    "action" => "getByVille",
    "_ext" => "json"
]);
echo $this->Html->scriptBlock('var urlToLinkedListFilter = "' . $urlToLinkedListFilter . '";', ['block' => true]);
echo $this->Html->script('Comptes/add', ['block' => 'scriptBottom']);
?>
<nav class="float-left" style="max-width: 20rem;">

    <div class="list-group m-3">
        <?= $this->Form->postLink(
            __('Supprimer le compte'),
            ['action' => 'delete', $compte->id], ['class' => 'list-group-item list-group-item-action bg-danger text-white', 'confirm' => __('Voulez vous vraiment supprimer le compte # {0}?', $compte->id)]
        )
        ?>
        <?= $this->Html->link(__('Consulter la liste des comptes banquaires'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
        <?php
            echo $this->Html->link(__('Consulter la liste des utilisateurs'), ['prefix' => false, 'controller' => 'Users', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']);
        ?>
    </div>

</nav>

<div class="container">
    <br>
    <?= $this->Form->create($compte) ?>
    <fieldset>
        <legend><?= __('Modifier Compte') ?></legend>
        <?php
            echo $this->Form->control('type_compte', ['label' => __('Type de compte')]);
            echo $this->Form->control('nom', ['label' => __('Nom du compte')]);
            echo $this->Form->control('Ville_id', ['options' => $villes, 'label' => __('Ville'), 'default' => $compte->institution->ville->id]);
            echo $this->Form->control('institution_id', ['default' => $compte['institution_id']]);
            echo $this->Form->control('file_id', ['options' => $files, 'empty' => true, 'label' => __('Image')]);
            echo $this->Form->control('users._ids', ['options' => $users, 'label' => __('Utilisateurs reliés')]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Soumettre'), array('class' => 'btn btn-outline-primary')) ?>
    <?= $this->Form->end() ?>
</div>
