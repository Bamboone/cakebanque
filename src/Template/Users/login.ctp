<h1>Login</h1>
<?= $this->Form->create() ?>
<?= $this->Form->control('email') ?>
<?= $this->Form->control('password') ?>
<?= $this->Form->button('Connexion', array('class' => 'btn btn-outline-primary'))?>
<?= $this->Form->end() ?>