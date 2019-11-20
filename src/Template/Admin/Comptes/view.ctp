<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Compte $compte
 */
use Cake\I18n\Number;
$loguser = $this->request->getSession()->read('Auth.User');
?>
<nav class="float-left" style="max-width: 20rem;">

    <div class="list-group m-3">
        <?= $this->Html->link(__('Modifier le compte banquaire'), ['action' => 'edit', $compte->id], ['class' => 'list-group-item list-group-item-action bg-success text-white']) ?>
        <?= $this->Form->postLink(
            __('Supprimer le compte banquaire'),
            ['action' => 'delete', $compte->id], ['class' => 'list-group-item list-group-item-action bg-danger text-white', 'confirm' => __('Voulez vous vraiment supprimer l\'utilisateur # {0}?', $compte->id)]
        )
        ?>
        <?= $this->Html->link(__('Consulter la liste des comptes banquaires'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
        <?= $this->Html->link(__('Ajouter un nouveau compte banquaire'), ['action' => 'add'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
        <?php
        echo $this->Html->link(__('Consulter la liste des utilisateurs'), ['prefix' => false, 'controller' => 'Users', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']);
        ?>
        <?= $this->Html->link(__('Télécharger en version pdf'), ['prefix' => false, 'action' => 'view', $compte->id . '.pdf'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
    </div>

</nav>

<div class="container">
    <div class="card border-primary mb-3 mt-3">
        <div class="card-header"><h4><?= h($compte->nom) ?></h4></div>
        <div class="card-body">
            <?php
                if($compte->file !=null){
                    echo $this->Html->image($compte->file->path . $compte->file->name, [
                "alt" => $compte->file->name, "class" => "img-thumbnail float-right", "style" => "width:300px;height:200px;"
                ]);
                }
            ?>

            <div class="card-text float-left">
                <strong><?=__('Type de compte') ?>: </strong><?= h($compte->type_compte) ?> <br>
                <strong><?=__('Ville') ?>: </strong><?= h($compte->institution->ville->nom) ?> <br>
                <strong><?=__('Institution') ?>: </strong><?= h($compte->institution->name) ?> <br>
                <strong><?=__('Balance') ?>: </strong><?= Number::currency(h($compte->balance), null, ['places' => 2]) ?> <br>
                <strong><?=__('Date de création') ?>: </strong><?= h($compte->created) ?> <br>

                <hr>
                <h5 class="card-title mt-3"><?= __('Utilisateurs reliés')?></h5>
                <?php foreach ($compte->users as $users): ?>
                    <strong class="m-3"><?= h($users->username) ?></strong>
                    <div class="list-group list-group-horizontal m-3">
                        <?php
                            echo $this->Html->link(__('Consulter'), ['controller' => 'Users', 'action' => 'view', $users->id], ['class' => 'list-group-item list-group-item-action bg-primary text-white']);
                            echo $this->Html->link(__('Modifier'), ['controller' => 'Users', 'action' => 'edit', $users->id], ['class' => 'list-group-item list-group-item-action bg-success text-white']);
                            echo $this->Form->postLink(__('Supprimer'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['class' => 'list-group-item list-group-item-action bg-danger text-white', 'confirm' => __('Voulez vous vraiment supprimer l\'utilisateur # {0}?', $users->id)]);
                        ?>

                    </div>
                    <hr>
                <?php endforeach; ?>
                <h5 class="card-title mt-3"><?= __('Transactions')?></h5>
                <?php foreach ($compte->transactions as $transaction): ?>
                    <table class="table table-sm">
                        <tbody>
                            <tr>
                                <th scope="row"><?= h($transaction->created) ?></th>
                                <td><?= h($transaction->provenance) ?></td>
                                <td><?= h($transaction->type) ?></td>
                                <td><?= Number::currency(h($transaction->montant), null, ['places' => 2]) ?></td>
                            </tr>
                        </tbody>
                    </table>

                <?php endforeach; ?>
            </div>

        </div>
    </div>
</div>
