<div class="commodity_view page col_12_wrapper">
	<form method="post">
		<input type="hidden" name="action" value="update" />
		<header class="col_12">
			<div class="view_field">
				<h1>
					<?php echo $commodity->get('singular'); ?>
					<span class="store_group">
						<?php if($group = $commodity->get_store_group()) : ?>
							<?php echo $group->get('title'); ?>
						<?php endif; ?>
					</span>
				</h1>
			</div>
			<div class="edit_field">
				<select name="grammar_article">
					<option value=""></option>
					<option value="en">En</option>
					<option value="ett">Ett</option>
				</select>
				
				<input name="singular" type="text" value="<?php echo htmlspecialchars($commodity->get('singular')); ?>" />
				
				<label>flera</label>
				<input name="plural" type="text" value="<?php echo htmlspecialchars($commodity->get('plural')); ?>" />
			</div>
			<div class="edit_controls">
				<div class="view_field">
					<span class="edit_control link">Redigera</span>
				</div>
				<div class="edit_field">
					<input type="submit" value="save" />
				</div>
			</div>
		</header>

		<section class="Top Fullwidth">
			<div class="Description col_4">
				<div class="view_field multicolumn">
					<p>
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus id pulvinar libero. Sed accumsan metus id turpis molestie sed porttitor sem feugiat. Integer lacus erat, eleifend non suscipit nec, mollis ut est. Fusce leo leo, cursus vitae fermentum vel, volutpat ut leo.
					</p>

					<p>
						Nullam eros metus, sodales eu tincidunt et, pellentesque aliquam augue. Quisque quis tortor ut tellus tempus consequat. Proin ultrices odio ut orci tempus aliquet. Phasellus placerat luctus ipsum, ut venenatis ipsum fermentum ac.
					</p>
				</div>
				<div class="edit_field">
					<textarea></textarea>
					<input type="submit" value="Spara" />
				</div>
			</div>
			<figure class="Picture col_8">
				<div class="view_field">
					<img src="<?php echo $commodity->get('main_imagecrop')->image_url(array('w' => 400)); ?>" />
				</div>
				
				<div class="edit_field">
					<?php echo $commodity->get('main_imagecrop')->selector(array('name' => 'main_image')); ?>	
				</div>
			</figure>
		</section>


		<br style="clear: both;" />


		<div class="col_12">
			<h3>Recept med <?php echo $commodity->get('singular'); ?></h3>
		</div>
		<?php if(count($recipes = $commodity->get_associated_recipes(array('limit' => 5))) > 0) : ?>
			<?php echo Recipe::render_list($recipes); ?>
		<?php endif; ?>
		<br style="clear: both;" />
	</form>

	<?php foreach($commodity->get_children() AS $child): ?>
		<form method="post">
			<h2><?php echo $child->get('singular'); ?></h2>
		</form>
	<?php endforeach; ?>

	<br style="clear: both;" />
</div>
