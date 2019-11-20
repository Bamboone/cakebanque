<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Compte $compte
 */
$loguser = $this->request->getSession()->read('Auth.User');
$urlToLinkedListFilter = $this->Url->build([
    "controller" => "Villes",
    "action" => "getVilles",
    "_ext" => "json"
]);
echo $this->Html->scriptBlock('var urlToLinkedListFilter = "' . $urlToLinkedListFilter . '";', ['block' => true]);
echo $this->Html->script('Comptes/listes', ['block' => 'scriptBottom']);
?>
<nav class="float-left" style="max-width: 20rem;">

    <div class="list-group m-3">
        <?= $this->Html->link(__('Consulter la liste des comptes banquaires'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>

    </div>

</nav>
<div class="container" ng-app="linkedlists" ng-controller="villesController">
    <br>
    <?= $this->Form->create($compte) ?>
    <fieldset>
        <legend><?= __('Ajouter un compte banquaire') ?></legend>
        <?php
        echo $this->Form->control('type_compte', ['label' => __('Type de compte')]);
        echo $this->Form->control('nom', ['label' => __('Nom du compte')] );
        echo $this->Form->control('Ville_id', ['label' => __('Ville'), 'id' => 'ville-id', 'ng-model'=>'ville', 'ng-options' => 'ville.nom for ville in villes track by ville.id']);
        echo $this->Form->control('institution_id', ['label' => __('Institution'), 'id' => 'institution-id', 'ng-model'=>'institution', 'ng-options' => 'institution.name for institution in ville.institutions track by institution.id', 'ng-disabled'=>'!ville']);
        echo $this->Form->control('file_id', ['options' => $files, 'label' => __('Image')]);
        echo $this->Form->control('users._ids', ['options' => $users, 'label' => __('Utilisateurs'), 'default' => $loguser]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Soumettre'), array('class' => 'btn btn-outline-primary')) ?>
    <?= $this->Form->end() ?>
</div>
