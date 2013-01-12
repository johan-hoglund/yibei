<div class="commodity_view">
	<form method="post">
		<input type="hidden" name="action" value="update" />

		<head>
			<div class="view_field">
				<h1><?php echo $commodity->get('singular'); ?></h1>
			</div>
			<div class="edit_field">
				<select name="grammar_article">
					<option value=""></option>
					<option value="en">En</option>
					<option value="ett">Ett</option>
				</select>
				
				<input name="singular" type="text" />
				
				<label>flera</label>
				<input name="plural" type="text" />
			</div>
			<div class="edit_controls">
				<div class="view_field">
					<span class="edit_control">Redigera</span>
				</div>

				<div class="edit_field">
					<input type="submit" value="save" />
				</div>
			</div>
		</head>

		<div class="head">
			<div class="short_description">
				<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus id pulvinar libero. Sed accumsan metus id turpis molestie sed porttitor sem feugiat. Integer lacus erat, eleifend non suscipit nec, mollis ut est. Fusce leo leo, cursus vitae fermentum vel, volutpat ut leo.
				</p>

				<p>
					Nullam eros metus, sodales eu tincidunt et, pellentesque aliquam augue. Quisque quis tortor ut tellus tempus consequat. Proin ultrices odio ut orci tempus aliquet. Phasellus placerat luctus ipsum, ut venenatis ipsum fermentum ac.
				</p>
			</div>

			<div class="image">
				<div class="view_field">
					<img src="<?php echo $commodity->get('main_imagecrop')->image_url(array('w' => 400)); ?>" />
				</div>
				
				<div class="edit_field">
					<?php echo $commodity->get('main_imagecrop')->selector(array('name' => 'main_image')); ?>	
				</div>
			</div>
		</div>
		<br style="clear: both;" />


		<h3>Recept med <?php echo $commodity->get('singular'); ?></h3>
		<?php if(count($recipes = $commodity->get_associated_recipes(array('limit' => 5))) > 0) : ?>
			<?php echo yibei_recipe::render_list($recipes); ?>
		<?php endif; ?>
		<br style="clear: both;" />
	</form>
</div>
