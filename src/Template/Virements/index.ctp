<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Virement[]|\Cake\Collection\CollectionInterface $virements
 */
$loguser = $this->request->getSession()->read('Auth.User');

use Cake\I18n\Number; ?>
<nav class="float-left" style="max-width: 20rem;">

    <div class="list-group m-3">
        <?= $this->Html->link(__('Faire un virement'), ['action' => 'add'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
        <?= $this->Html->link(__('Consulter la liste des comptes banquaires'), ['controller' => 'Comptes', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
        <?= $this->Html->link(__('Ajouter un nouveau compte banquaire'), ['controller' => 'Comptes', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action bg-primary text-white']) ?>
    </div>
    <br>
    <div class="card border-secondary m-3" style="max-width: 20rem;">
        <div class="card-header"><?='Trier les virements par'?></div>
        <div class="card-body">
            <div class="list-group">
                <?= $this->Paginator->sort('email', 'Destinataire') ?>
                <?= $this->Paginator->sort('montant') ?>
            </div>
        </div>
    </div>

</nav>
<br>
<div class="container">
    <br>
    <h3><?= __('Virements') ?></h3>
        <table class="table table-sm">
            <tbody>
            <?php foreach ($virements as $virement): ?>

                        <tr>
                            <th scope="row"><?=  Number::currency($virement->montant) ?></th>
                            <td style="width: 50%">Envoyé à <?= h($virement->email) ?></td>
                            <td>
                                <div class="list-group list-group-horizontal">
                                    <?= $this->Html->link(__('Consulter'), ['action' => 'view', $virement->id], ['class' => 'list-group-item list-group-item-action text-white bg-primary']) ?>
                                    <?php
                                    if($loguser['role'] === 'admin'){
                                        echo $this->Html->link(__('Modifier'), ['action' => 'edit', $virement->id], ['class' => 'list-group-item list-group-item-action text-white bg-success']);
                                        echo $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $virement->id], ['class' => 'list-group-item list-group-item-action text-white bg-danger', 'confirm' => __('Voulez-vous vraimer supprimer le virement # {0}?', $virement->id)]);
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
