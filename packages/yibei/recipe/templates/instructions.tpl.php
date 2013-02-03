<div class="recipe_full<?php echo isset($recipe) ? '' : ' create'; ?> col_9_wrapper page">
	<form method="post" action="/recept/spara">
		<?php if(isset($recipe)) : ?>
			<input type="hidden" name="parent_recipe" value="<?php echo $recipe->get('id'); ?>" />
			<input type="hidden" name="edit_mode" value="vary" />
		<?php endif; ?>
		<header>
			<div class="title col_9">
				<?php if(isset($recipe)) : ?>
					<div class="view_field">
						<span class="correct_control link">Korrigera</span>
						<span class="vary_control link">Variera</span>
					</div>
				<?php endif; ?>
				<div class="edit_field">
					<input type="submit" value="Spara" class="button green" />
					<button class="cancel_control button grey">Avbryt</button>
				</div>
				<?php if(isset($recipe)) : ?>
					<h1 class="view_field"><?php echo $recipe->get('title'); ?></h1>
				<?php endif; ?>
				<div class="edit_field">
					<?php $val = isset($recipe) ? $recipe->get('title') : ''; ?>
					<input type="text" name="title" value="<?php echo $val; ?>" />
				</div>
			</div>
			<div class="edit_field background_control">
				<input type="hidden" name="bg_handle"<?php echo (isset($recipe) && $bg = $recipe->get('top_bg')) ? ' value="' . $bg->get('handle') . '"' : ''; ?> />
				<input type="hidden" name="bg_x1"<?php echo (isset($recipe) && $bg = $recipe->get('top_bg')) ? ' value="' . $bg->get('x1') . '"' : ''; ?> />
				<input type="hidden" name="bg_x2"<?php echo (isset($recipe) && $bg = $recipe->get('top_bg')) ? ' value="' . $bg->get('x2') . '"' : ''; ?> />
				<input type="hidden" name="bg_y1"<?php echo (isset($recipe) && $bg = $recipe->get('top_bg')) ? ' value="' . $bg->get('y1') . '"' : ''; ?> />
				<input type="hidden" name="bg_y2"<?php echo (isset($recipe) && $bg = $recipe->get('top_bg')) ? ' value="' . $bg->get('y2') . '"' : ''; ?> />
				<input type="hidden" name="aspect_ratio" value="16:9" />
				<div class="button">Byt bild</div>
			</div>
			<?php if(isset($recipe) && $bg = $recipe->get('top_bg')) : ?>
				<div class="image">
					<img src="<?php echo $bg->image_url(array('w' => 750)); ?>" />
				</div>
			<?php endif; ?>
		</header>
		<div class="guide">
			<?php if(user::current()->is_anonymous()) : ?>
				<div class="edit_field notification warning">
					<h3>Du är inte inloggad</h3>
					<p>
						Om du redigerar recept utan att vara inloggad på Yibei, kommer dina ändringar att ta längre tid att synas, då de granskas först.
						Dessutom missar du möjligheten att få ditt namn presenterat vid recept och få notiser när någon lagar eller kommenterar ditt recept.
					</p>
				</div>
			<?php endif; ?>
			
			<div class="description col_9">
				<?php if(isset($recipe)) : ?>
					<div class="view_field">
						<p class="multicolumn"><?php echo $recipe->get('description'); ?></p>
					</div>
				<?php endif; ?>
				<div class="edit_field">
					<label>Beskrivning</label>
					<textarea name="description"></textarea>
				</div>
			</div>

			<div class="instructions col_6">
				<h3>Gör så här</h3>
				<ol class="preparation_steps">
					<?php if(isset($recipe)) : ?>
						<?php foreach($recipe->get('preparation_steps') AS $step) : ?>
							<li>
								<div class="view_field">
									<?php echo $step->get('text')->html_safe(); ?>
								</div>
								<div class="edit_field">
									<textarea name="preparation_steps[]"><?php echo $step->get('text')->html_safe(); ?></textarea>
								</div>
							</li>
						<?php endforeach; ?>
					<?php endif; ?>
					<li class="edit_field">
						<textarea name="preparation_steps[]"></textarea>
					</li>
				</ol>
			</div>

			<div class="panel col_3">
				<h4>Ingredienser</h4>
				<div class="RecipeIngredientLists">
					<?php if(isset($recipe)) : ?>
						<?php foreach($recipe->ingredientLists() AS $list) : ?>
							<?php echo $list->render(); ?>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
				<div class="RecipeIngredientListTemplate">
					<?php echo RecipeIngredientList::render_template(); ?>
				</div>
				<span class="addRecipeIngredientListControl edit_field link">+ Ingredienslista</span>
				
				
				<div class="ingredients edit_field">
					<h4>Gammal ingredienslista</h4>
					<ul>
						<?php if(isset($recipe)) : ?>
							<?php foreach($recipe->get('Ingredients') AS $entry) : ?>
								<li>
									<span class="shopping_list_add_item" data-amount="<?php echo $entry->get('amount'); ?>" data-unit="<?php echo $entry->get('unit'); ?>" data-readable-amount="<?php echo $entry->get('readable_amount'); ?>" data-id="<?php echo $entry->get('commodity')->get('id'); ?>" data-title="<?php echo $entry->get('commodity')->get('singular'); ?>">
										<img src="/static/yibei_page/icons/shopping_cart.svg" height="15" />
									</span>
									<span class="amount">
										<?php echo $entry->get_readable_amount(); ?>
										<?php echo $entry->get('unit'); ?>
									</span>
									<span class="commodity">
										<a href="<?php echo $entry->get('commodity')->get('url'); ?>">
											<?php echo $entry->get('commodity')->get('singular'); ?>
										</a>
									</span>
								</li>
							<?php endforeach; ?>
						<?php endif; ?>
						<li class="edit_field">
							<div>
								<input type="text" name="amounts[]" />
								<?php echo Ingredient::units_dropdown('units[]')->render(); ?>
								<input type="text" name="commodities[]" />
							</div>
						</li>
					</ul>
					<span class="shopping_list_add_all_control link">Allt till inköpslistan</span>
				</div>
				<div class="equipment">
					<div class="view_field">
						<h4>Utrustning</h4>
					</div>
					<div class="edit_field">
						<h4>Utrustning</h4>
					</div>
				</div>
			</div>
			<br style="clear: both;" />
		</div>
	</form>
</div>
