<div class="ShoppingList">
	<h1>Inköpslista</h1>
	<?php foreach($list->get_groups() AS $group) : ?>
		<h3><?php echo $group->get('title'); ?></h3>
		<ul>
			<?php foreach($list->items_by_group($group) AS $item) : ?>
				<li>
					<?php if($is_owner) : ?>
						<input type="checkbox" value="<?php echo $item->get('commodity_id'); ?>" />
					<?php endif; ?>
					<span class="commodity">
						<a href="<?php echo $item->get('commodity')->get('url'); ?>">
							<?php echo $item->get('commodity')->get('singular'); ?>
						</a>
					</span>
					<?php if($is_owner) : ?>
						<span class="remove_control">(<span>x</span>)</span>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php endforeach; ?>
	<?php if($is_owner) : ?>
		<div class="add_dialogue">
			<h2>Nya artiklar</h2>
			<form method="post">
				<textarea name="new_articles"></textarea>
				<input type="submit" value="Lägg till" />
			</form>
		</div>
	<?php endif; ?>
</div>
