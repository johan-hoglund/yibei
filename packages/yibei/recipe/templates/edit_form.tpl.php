<form method="post" class="recipe_edit">

	<label>Namn</label>
	<input type="text" value="<?php echo $recipe->get('title'); ?>" name="title" />

	<label>Bild</label>
	<?php echo $recipe->get('top_bg')->selector(); ?>

	<label>Ingredienser</label>
	<textarea name="ingredients"><?php echo $recipe->get('ingredients'); ?></textarea>

	<label>Instruktioner</label>
	<textarea name="instructions"><?php echo $recipe->get('instructions'); ?></textarea>


	<input type="submit" value="Spara" />
</form>
