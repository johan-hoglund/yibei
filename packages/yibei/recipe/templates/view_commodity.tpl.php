<div class="commodity_view">
	<h1><?php echo $commodity->get('singular'); ?></h1>

	<h3>Recept med denna ingrediens</h3>
	<?php if(count($recipes = $commodity->get_associated_recipes(array('limit' => 5))) > 0) : ?>
		<?php echo yibei_recipe::render_list($recipes); ?>
	<?php endif; ?>
</div>
