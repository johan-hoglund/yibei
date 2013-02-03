<?php $columns = isset($columns) ? $columns : 3; ?>
<?php $fixed = isset($fixed) && $fixed ? ' fixed' : ''; ?>
<ul class="recipe_list <?php echo $mode . $fixed; ?>">
	<?php foreach($recipes AS $recipe) : ?>
		<li class="col_<?php echo $columns; ?> vmarg">
			<div class="spacer">
				<?php if($recipe->get('top_bg') && strlen($recipe->get('top_bg')->get('handle')) > 0) : ?>
					<img src="<?php echo $recipe->get('top_bg')->image_url(array('w' => 250)); ?>" />
				<?php else : ?>
					<img src="/static/recipe/recipe-placeholder.svg" />
				<?php endif; ?>
				<div class="text">
					<a href="<?php echo $recipe->get_url(); ?>" class="heading"><?php echo $recipe->get('title'); ?></a>
					<span class="ingredients">
						<?php echo ucfirst(implode(', ', array_map(function($a) { return $a->get('commodity')->get('singular'); }, array_slice($recipe->get('Ingredients'), 0, 4)))); ?>
					</span>
				</div>
			</div>
		</li>
	<?php endforeach; ?>
</ul>
