<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Message[]|\Cake\Collection\CollectionInterface $messages
 */
$loguser = $this->request->getSession()->read('Auth.User');
?>
<nav class="float-left" style="max-width: 20rem;">

    <div class="list-group m-3">

        <?php
        if($loguser['role'] === 'admin'){
            echo $this->Html->link(__('Écrire un message'), ['action' => 'add'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']);
            echo $this->Html->link(__('Consulter la liste des utilisateurs'), ['controller' => 'Users', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']);
        }
        ?>

    </div>
    <br>
    <div class="card border-secondary m-3" style="max-width: 20rem;">
        <div class="card-header"><?=__('Trier les messages par')?></div>
        <div class="card-body">
            <div class="list-group">
                <?= $this->Paginator->sort('titre', __('Titre')) ?>
                <?= $this->Paginator->sort('created', __('Date d\'envoi')) ?>
            </div>
        </div>
    </div>
</nav>
<div class="container">
    <br>
    <h3><?= __('Messages') ?></h3>

    <table class="table table-sm">
        <tbody>
        <?php foreach ($messages as $message): ?>
        <tr>
            <th scope="row"><?= h($message->created) ?></th>
            <td style="width: 50%"><?= h($message->titre) ?></td>
            <td>
                <div class="list-group list-group-horizontal">
                    <?= $this->Html->link(__('Consulter'), ['action' => 'view', $message->id], ['class' => 'list-group-item list-group-item-action text-white bg-primary']) ?>
                    <?php
                    if($loguser['role'] === 'admin'){
                        echo $this->Html->link(__('Modifier'), ['action' => 'edit', $message->id], ['class' => 'list-group-item list-group-item-action text-white bg-success']);
                        echo $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $message->id], ['class' => 'list-group-item list-group-item-action text-white bg-danger', 'confirm' => __('Voulez-vous vraimer supprimer le message # {0}?', $message->id)]);
                    }
                    ?>
                </div>

            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
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
