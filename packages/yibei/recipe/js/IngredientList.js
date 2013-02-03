var RecipeIngredientListCreateCount = 0;

$(document).ready(function() {
	$('.addRecipeIngredientListControl').click(function() {
		var template = $(this).siblings('.RecipeIngredientListTemplate').clone(true);
		template.removeClass('RecipeIngredientListTemplate');

		template.find('input').each(function(index, val) {
			$(val).attr('name', $(val).attr('name').replace('KEY', 'new_' + RecipeIngredientListCreateCount));
			$(val).removeAttr('disabled');
		});
		RecipeIngredientListCreateCount++;

		template.appendTo($(this).siblings('.RecipeIngredientLists'));
	});

	$('.RecipeIngredientList table input').keyup(function() {
		var filled = false;
			
		$(this).closest('tr').find('input').each(function(index, val) {
			if($(val).val().length > 0)
			{
				filled = true;
			}
		});


		if($(this).closest('tr').is(':last-child') && filled)
		{
			var clone = $(this).closest('tr').clone(true);
			clone.find('input').val('');
			$(this).closest('tr').after(clone);
		}
		
		if(!$(this).closest('tr').is(':last-child') && !filled)
		{
			$(this).closest('tr').remove();
		}

		console.log($(this).val());
	});
});
