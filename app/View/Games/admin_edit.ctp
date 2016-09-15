<div class="games form">
<?php echo $this->Form->create('Game'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Game'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('type_id');
		echo $this->Form->input('name');
		echo $this->Form->input('publisher');
		echo $this->Form->input('publish_date');
		echo $this->Form->input('price');
		echo $this->Form->input('amount');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Game.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Game.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Games'), array('action' => 'index')); ?></li>
	</ul>
</div>
