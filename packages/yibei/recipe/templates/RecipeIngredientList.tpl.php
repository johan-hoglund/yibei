<div class="RecipeIngredientList">
	<?php if(isset($list) && strlen($list->get('label')) > 0) : ?>
		<div class="view_field">
			<h5><?php echo $list->get('label'); ?></h5>
		</div>
	<?php endif; ?>
	<div class="edit_field">
		<?php if(isset($list)) : ?>
			<input type="text" data-name="label" name="RecipeIngredientLists[<?php echo $list->get('id'); ?>][label]" value="<?php echo htmlentities($list->get('title')); ?>" />
		<?php else : ?>
			<input type="text" data-name="label" disabled="disabled" name="RecipeIngredientLists[KEY][label]" />
		<?php endif; ?>
	</div>
	<table>
		<thead class="edit_field">
			<tr>
				<th>Antal</th>
				<th>Enhet</th>
				<th>Råvara</th>
			</tr>
		</thead>
		<tbody>
			<?php if(isset($list)) : ?>
				<?php foreach($list->members() AS $member) : ?>
					<tr>
						<td class="amount">
							<input class="edit_field" type="text" name="RecipeIngredientLists[<?php echo $list->get('id'); ?>][amounts][]" value="<?php echo $member->get('amount'); ?>">
							<span class="view_field"><?php echo $member->get('readable_amount'); ?></span>
						</td>
						<td>
							<input class="edit_field" type="text" name="RecipeIngredientLists[<?php echo $list->get('id'); ?>][units][]" value="<?php echo $member->get('unit'); ?>">
							<span class="view_field"><?php echo $member->get('unit'); ?></span>
						</td>
						<td>
							<input class="edit_field"  type="text" name="RecipeIngredientLists[<?php echo $list->get('id'); ?>][commodities][]" value="<?php echo $member->get('commodity')->get('plural'); ?>">
							<span class="view_field"><?php echo $member->get('commodity')->get('plural'); ?></span>
						</td>
					</tr>
				<?php endforeach; ?>
				<tr class="edit_field">
					<td><input type="text" name="RecipeIngredientLists[<?php echo $list->get('id'); ?>][amounts][]"></td>
					<td><input type="text" name="RecipeIngredientLists[<?php echo $list->get('id'); ?>][units][]"></td>
					<td><input type="text" name="RecipeIngredientLists[<?php echo $list->get('id'); ?>][commodities][]"></td>
				</tr>
			<?php else : ?>
				<tr class="edit_field">
					<td><input type="text" disabled="disabled" name="RecipeIngredientLists[KEY][amounts][]"></td>
					<td><input type="text" disabled="disabled" name="RecipeIngredientLists[KEY][units][]"></td>
					<td><input type="text" disabled="disabled" name="RecipeIngredientLists[KEY][commodities][]"></td>
				</tr>
			<?php endif; ?>
		</tbody>
	</table>
</div>


