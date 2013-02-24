<div class="ShoppingList col_12_wrapper">
	<div class="col_12">
		<h1>Inköpslista</h1>
		<div class="groups">
			<?php foreach($list->get_groups() AS $group) : ?>
				<h3><?php echo $group->get('title'); ?></h3>
				<ul data-group_id="<?php echo $group->get('id'); ?>">
					<?php foreach($list->items_by_group($group) AS $item) : ?>
						<li data-commodity_id="<?php echo $item->get('commodity_id'); ?>">
							<?php if($is_owner) : ?>
								<input type="checkbox" value="<?php echo $item->get('commodity_id'); ?>" />
							<?php endif; ?>
							<span class="commodity">
								<?php echo $item->get('amount'); ?>
								<?php echo $item->get('unit'); ?>
								<a href="<?php echo $item->get('commodity')->get('url'); ?>">
									<?php echo $item->get('commodity')->get('singular'); ?>
								</a>
							</span>
							<?php if($is_owner) : ?>
								<span class="remove_control"><span>x</span></span>
							<?php endif; ?>
						</li>
					<?php endforeach; ?>
				</ul>
				...
			<?php endforeach; ?>
		</div>
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
</div>
