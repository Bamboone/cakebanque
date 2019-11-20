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

$cakeDescription = 'Banque Web';
use Cake\I18n\I18n;
$loguser = $this->request->getSession()->read('Auth.User');
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
    <script src="https://kit.fontawesome.com/88d95153ea.js" crossorigin="anonymous"></script>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('bootstrap') ?>
    <?= $this->Html->css('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css') ?>
    <?= $this->Html->css('https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css') ?>
    <?= $this->Html->script('jquery-3.4.1.js') ?>
    <?= $this->Html->script('bootstrap.js') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <?php
    echo $this->Html->script([
            'https://ajax.googleapis.com/ajax/libs/angularjs/1.7.8/angular.min.js',
            'https://code.jquery.com/jquery-1.12.4.js',
            'https://code.jquery.com/ui/1.12.1/jquery-ui.js'
    ], ['block' => 'scriptLibraries']
    );
    ?>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
    <a class="navbar-brand" href="#">Banque Web</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <?= $this->Html->link(__('Comptes banquaires'), ['prefix' => false, 'controller' => 'Comptes', 'action' => 'index'], ['class' => 'nav-link']);?>
            </li>
            <li class="nav-item">
                <?= $this->Html->link(__('Messages'), ['prefix' => false, 'controller' => 'Messages', 'action' => 'index'], ['class' => 'nav-link']);?>
            </li>
            <li class="nav-item">
                <?= $this->Html->link(__('Virements'), ['prefix' => false, 'controller' => 'Virements', 'action' => 'index'], ['class' => 'nav-link']);?>
            </li>

                <?php
                if ($loguser['role'] === 'admin') {
                    echo '<li class="nav-item">';
                    echo $this->Html->link(__('Transactions'), ['prefix' => false, 'controller' => 'Transactions', 'action' => 'index'], ['class' => 'nav-link']);
                    echo '</li>';
                    echo '<li class="nav-item">';
                    echo $this->Html->link(__('Images'), ['prefix' => false, 'controller' => 'Files', 'action' => 'index'], ['class' => 'nav-link']);
                    echo '</li>';
                    echo '<li class="nav-item">';
                    echo $this->Html->link(__('Institutions'), ['prefix' => false, 'controller' => 'Institutions', 'action' => 'index'], ['class' => 'nav-link']);
                    echo '</li>';
                    echo '<li class="nav-item">';
                    echo $this->Html->link(__('Villes'), ['prefix' => false, 'controller' => 'Villes', 'action' => 'index'], ['class' => 'nav-link']);
                    echo '</li>';
                    echo '<li class="nav-item">';
                    echo $this->Html->link(__('Comptes banquaires (vue admin)'), ['prefix' => 'admin', 'controller' => 'Comptes', 'action' => 'index'], ['class' => 'nav-link']);
                    echo '</li>';
                }
                ?>
            <li class="nav-item">
                <?= $this->Html->link(__('À propos'), '/html/index.html', ['class' => 'nav-link']);?>
            </li>



        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php
                    if (I18n::getLocale() == 'en_US'){
                        echo 'English';
                    }else if(I18n::getLocale() == 'zh_CN'){
                        echo '普通话';
                    }else{
                        echo 'Francais';
                    }
                    ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <?= $this->Html->link('Français', ['action' => 'changeLang', 'fr_CA'], ['class' => 'dropdown-item'], ['escape' => false]) ?>
                    <?= $this->Html->link('English', ['action' => 'changeLang', 'en_US'], ['class' => 'dropdown-item'], ['escape' => false]) ?>
                    <?= $this->Html->link('普通话', ['action' => 'changeLang', 'zh_CN'], ['class' => 'dropdown-item'], ['escape' => false]) ?>
                </div>
            </li>
            <li class="nav-item">
                <?php
                if ($loguser) {
                    $user = $loguser['name'];
                    $userId = $loguser['id'];
                    echo $this->Html->link($user, ['prefix' => false, 'controller' => 'Users', 'action' => 'view', $userId], ['class' => 'nav-link']);
                } else {
                    echo $this->Html->link(__('Créer un compte'), ['prefix' => false, 'controller' => 'Users', 'action' => 'add'], ['class' => 'nav-link']);
                }
                ?>

            </li>
            <li class="nav-item">
                <?php
                if ($loguser) {
                    echo $this->Html->link(__(' Déconnecter'), ['prefix' => false, 'controller' => 'Users', 'action' => 'logout'], ['class' => 'nav-link']);
                } else {
                    echo $this->Html->link(__('Connecter'), ['prefix' => false, 'controller' => 'Users', 'action' => 'login'], ['class' => 'nav-link']);
                }
                ?>
            </li>
        </ul>



    </div>
</nav>



<div>
    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
</div>
<footer>
</footer>
<?= $this->fetch('scriptLibraries') ?>
<?= $this->fetch('script'); ?>
<?= $this->fetch('scriptBottom') ?>
</body>
</html>
