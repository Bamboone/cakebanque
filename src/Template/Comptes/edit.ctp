<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Compte $compte
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $compte->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $compte->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Comptes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="comptes form large-9 medium-8 columns content">
    <?= $this->Form->create($compte) ?>
    <fieldset>
        <legend><?= __('Edit Compte') ?></legend>
        <?php
            echo $this->Form->control('type_compte');
            echo $this->Form->control('date', [ 'minYear' => 1900, 'maxYear' => date('Y') ]);
            echo $this->Form->control('image');
            echo $this->Form->control('user_id');
            echo $this->Form->control('users._ids', ['options' => $users]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
