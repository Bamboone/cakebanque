<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>

<nav class="float-left">

<div class="list-group">
<?= $this->Html->link(__('Nouveau utilisateur'), ['action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
<?= $this->Html->link(__('Liste des comptes banquaires'), ['controller' => 'Comptes', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
<?= $this->Html->link(__('Nouveau compte banquaire'), ['controller' => 'Comptes', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
</div>
<br>
<div class="card border-secondary mb-3" style="max-width: 20rem;">
  <div class="card-header">Trier les utilisateurs par</div>
  <div class="card-body">
    <div class="list-group">
          <?= $this->Paginator->sort('id')?>
          <?= $this->Paginator->sort('name', __('Nom')) ?>
          <?= $this->Paginator->sort('username', __('Nom d\'utilisateur')) ?>
          <?= $this->Paginator->sort('email', __('Courriel')) ?>
          <?= $this->Paginator->sort('password', __('Mot de passe')) ?>
          <?= $this->Paginator->sort('created', __('Date de création')) ?>
          <?= $this->Paginator->sort('modified', __('Date de modification')) ?>
        </div>
  </div>
</div>

</nav>
<div class="container ">

            <h3>Utilisateurs</h3>

            <?php foreach ($users as $user): ?>
            <div class="card border-primary mb-3">
              <div class="card-header"><?= h($user->name) ?></div>
              <div class="card-body">
                <div class="card-text float-left">
                   <strong>ID: </strong><?= $this->Number->format($user->id) ?> <br>
                   <strong>Nom d'utilisateur: </strong><?= h($user->username) ?> <br>
                   <strong>Courriel: </strong><?= h($user->email) ?> <br>
                   <strong>Mot de passe: </strong><?= h($user->password) ?> <br>
                   <strong>Date de création: </strong><?= h($user->created) ?> <br>
                   <strong>Date de modification: </strong><?= h($user->modified) ?> <br>
                </div>
                <div class="float-right">
                    <div class="list-group">
                        <?= $this->Html->link(__('Consulter'), ['action' => 'view', $user->id], ['class' => 'list-group-item list-group-item-action text-white bg-primary']) ?>
                        <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $user->id], ['class' => 'list-group-item list-group-item-action text-white bg-success']) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $user->id], ['class' => 'list-group-item list-group-item-action text-white bg-danger'], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
                    </div>
                </div>
              </div>
            </div>

            <?php endforeach; ?>

    <div>
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
