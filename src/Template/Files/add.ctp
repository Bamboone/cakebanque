<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\File $file
 */
?>
<div class="container">
    <br>
    <?= $this->Form->create($file, ['type' => 'file']) ?>
    <fieldset>
        <legend><?= __('Ajout d\'une image de compte') ?></legend>
        <br>
        <?php
        echo $this->Form->control('name', ['type' => 'file', 'label' => 'Nom du fichier']);
        // echo $this->Form->control('name');
        // echo $this->Form->control('path');
        echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Soumettre'), array('class' => 'btn btn-outline-primary')) ?>
    <?= $this->Form->end() ?>
</div>
