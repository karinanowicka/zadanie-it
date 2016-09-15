<div class="games view">
<h2><?php echo __('Game'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($game['Game']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($game['Type']['name'], array('controller' => 'types', 'action' => 'view', $game['Type']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($game['Game']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Publisher'); ?></dt>
		<dd>
			<?php echo h($game['Game']['publisher']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Publish Date'); ?></dt>
		<dd>
			<?php echo h($game['Game']['publish_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo h($game['Game']['price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Amount'); ?></dt>
		<dd>
			<?php echo h($game['Game']['amount']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Game'), array('action' => 'edit', $game['Game']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Game'), array('action' => 'delete', $game['Game']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $game['Game']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Games'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Game'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Types'), array('controller' => 'types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Type'), array('controller' => 'types', 'action' => 'add')); ?> </li>
	</ul>
</div>
