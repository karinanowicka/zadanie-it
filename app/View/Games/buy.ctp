<div class="games form">
<?php echo $this->Form->create('Client'); ?>
	<fieldset>
		<legend><?php echo __('Wprowadź adres e-mail'); ?></legend>
	<?php
		echo $this->Form->input('email');

	?>
	</fieldset>
<?php echo $this->Form->end(__('Kupuję')); ?>
</div>

<div class="actions">
	<h3><?php echo __('Sklep z grami'); ?></h3>

</div>
