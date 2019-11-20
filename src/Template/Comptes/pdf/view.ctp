<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Compte $compte
 */
use Cake\I18n\Number;
?>
<div class="card">
        <div class="card-header"><h4><?= h($compte->nom) ?></h4></div>
        <div class="card-body">
            <?php
                if($compte->file !=null){
                    echo $this->Html->image($compte->file->path . $compte->file->name, [
                "alt" => $compte->file->name, "class" => "img-thumbnail float-right", "style" => "width:300px;height:200px;"
                , 'fullBase' => true]);
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

