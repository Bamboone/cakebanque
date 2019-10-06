<div class="container">
    <br>
    <h1><?=__('Connexion')?></h1>
    <?= $this->Form->create() ?>
    <?= $this->Form->control('email', ['label' => __('Courriel')]) ?>
    <?= $this->Form->control('password', ['label' => __('Mot de passe')]) ?>
    <?= $this->Form->button(__('Connexion'), array('class' => 'btn btn-outline-primary'))?>
    <?= $this->Form->end() ?>
</div>

