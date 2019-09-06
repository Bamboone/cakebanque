<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('bootstrap') ?>
    <?= $this->Html->script('jquery-3.4.1.js') ?>
    <?= $this->Html->script('bootstrap.js') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">Banque Web</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Accueil <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Comptes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Transactions</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Versement</a>
            </li>
        </ul>
        <button class="btn btn-secondary mr-2" type="submit">
            <?php
                echo $this->Html->link('Créer un compte', ['controller' => 'Users', 'action' => 'add']);
            ?>
        </button>
        <button class="btn btn-secondary">
        <?php
        $loguser = $this->request->session()->read('Auth.User');
        if ($loguser) {
            $user = $loguser['email'];
            echo $this->Html->link($user . ' Déconnecter', ['controller' => 'Users', 'action' => 'logout']);
        } else {
            echo $this->Html->link('Connecter', ['controller' => 'Users', 'action' => 'login']);
        }
        ?>
        </button>



    </div>
</nav>



<div class="container">
    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
</div>
<footer>
</footer>
</body>
</html>
