<div class="types view">
<h2><?php echo __($type['Type']['name']); ?></h2>

	<h3><?php echo __('Gry dostępne w wybranym gatunku'); ?></h3>
	<?php if (!empty($type['Game'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Nazwa'); ?></th>
		<th><?php echo __('Wydawca'); ?></th>
		<th><?php echo __('Data publikacji'); ?></th>
		<th><?php echo __('Cena'); ?></th>
		<th class="actions"></th>
	</tr>
	<?php foreach ($type['Game'] as $game): ?>
		<tr>
			<td><?php echo $game['name']; ?></td>
			<td><?php echo $game['publisher']; ?></td>
			<td><?php echo $game['publish_date']; ?></td>
			<td><?php echo $game['price']; ?></td>
			<td class="actions">
				<?php if ($game['amount']>0): ?>
                                    <?php echo $this->Html->link(__('Kup'), array('controller' => 'games', 'action' => 'buy', $game['id'])); ?>
                                <?php else: ?>
                                    Brak na magazynie
                                <?php endif; ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>
<div class="actions">
	<h3><?php echo __('Sklep z grami'); ?></h3>

</div>