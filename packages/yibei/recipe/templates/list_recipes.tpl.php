<ul class="recipe_list <?php echo $mode; ?>">
	<?php foreach($recipes AS $recipe) : ?>
		<li>
			<?php if($recipe->get('top_bg') && strlen($recipe->get('top_bg')->get('handle')) > 0) : ?>
				<div class="picture">
					<img src="<?php echo $recipe->get('top_bg')->image_url(array('w' => 250)); ?>" />
				</div>
			<?php endif; ?>
			<div class="text">
				<a href="<?php echo $recipe->get_url(); ?>"><?php echo $recipe->get('title'); ?></a>
				<span class="ingredients">
					<?php echo ucfirst(implode(', ', array_map(function($a) { return $a->get('commodity')->get('singular'); }, array_slice($recipe->get('Ingredients'), 0, 4)))); ?>
				</span>
			</div>
		</li>
	<?php endforeach; ?>
</ul>
