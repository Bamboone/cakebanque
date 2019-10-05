<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>

<nav class="float-left">

<div class="list-group m-3">

<?= $this->Html->link(__('Ajouter un utilisateur'), ['action' => 'add'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
<?= $this->Html->link(__('Consulter la liste des comptes banquaires'), ['controller' => 'Comptes', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
<?= $this->Html->link(__('Créer un nouveau compte banquaire'), ['controller' => 'Comptes', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
</div>
<br>
<div class="card border-secondary m-3" style="max-width: 20rem;">
  <div class="card-header"><?=__('Trier les utilisateurs par')?></div>
  <div class="card-body">
    <div class="list-group">
          <?= $this->Paginator->sort('name', __('Nom')) ?>
          <?= $this->Paginator->sort('username', __('Nom d\'utilisateur')) ?>
          <?= $this->Paginator->sort('email', __('Courriel')) ?>
        </div>
  </div>
</div>

</nav>
<div class="container ">

            <h3><?=__('Utilisateurs')?></h3>

            <?php foreach ($users as $user): ?>
            <div class="card border-primary mb-3">
              <h4 class="card-header"><?= h($user->name) ?></h4>
              <div class="card-body">
                <div class="card-text float-left">
                   <strong><?=__('Nom d\'utilisateur')?>: </strong><?= h($user->username) ?> <br>
                   <strong><?=__('Courriel')?>: </strong><?= h($user->email) ?> <br>
                </div>
                <div class="float-right">
                    <div class="list-group list-group-horizontal">
                        <?= $this->Html->link(__('Consulter'), ['action' => 'view', $user->id], ['class' => 'list-group-item list-group-item-action text-white bg-primary']) ?>
                        <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $user->id], ['class' => 'list-group-item list-group-item-action text-white bg-success']) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $user->id], ['class' => 'list-group-item list-group-item-action text-white bg-danger', 'confirm' => __('Voulez vous vraiment supprimer l\'utilisateur # {0}?', $user->id)]) ?>
                    </div>
                </div>
              </div>
            </div>

            <?php endforeach; ?>

    <div>
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('Début')) ?>
            <?= $this->Paginator->prev('< ' . __('Précédent')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('Suivant') . ' >') ?>
            <?= $this->Paginator->last(__('Dernier') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} de {{pages}}, {{current}} entrée(s) montrée(s) sur un total de {{count}}')]) ?></p>
    </div>
</div>
