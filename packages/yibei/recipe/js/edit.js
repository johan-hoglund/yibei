$(document).ready(function() {
	$('.recipe_full .vary_control').click(function() {
		$(this).closest('.recipe_full').find('.edit_field').show(250);
		$(this).closest('.recipe_full').find('.view_field').hide();
		$(this).closest('form').find('input[name="edit_mode"]').val('vary');
	});
	
	$('.recipe_full .correct_control').click(function() {
		$(this).closest('.recipe_full').find('.edit_field').show(250);
		$(this).closest('.recipe_full').find('.view_field').hide();
		$(this).closest('form').find('input[name="edit_mode"]').val('correct');
	});

	$('.recipe_full .background_control .button').click(function() {
		var recipe_full = $(this).closest('.recipe_full');
		var i_handle = $(this).siblings('input[name="bg_handle"]');
		var i_x1 = $(this).siblings('input[name="bg_x1"]');
		var i_x2 = $(this).siblings('input[name="bg_x2"]');
		var i_y1 = $(this).siblings('input[name="bg_y1"]');
		var i_y2 = $(this).siblings('input[name="bg_y2"]');
		var options = {}
		if($(this).siblings('input[name="aspect_ratio"]'))
		{
			options.aspectRatio = $(this).siblings('input[name="aspect_ratio"]').val();
		}
		

		imagecrop_selector(function(ic) {
			i_handle.val(ic.handle);
			i_x1.val(ic.x1);
			i_x2.val(ic.x2);
			i_y1.val(ic.y1);
			i_y2.val(ic.y2);
			
			var bg = '/imagecrop/' + ic.handle + '/' + ic.x1 + '+' + ic.x2 + '_' + ic.y1 + '+' + ic.y2 + '/750x.png';
			$(recipe_full).find('header').css('background', 'url("' + bg + '")');
		}, options);
	});

	if($('.recipe_full .preparation_steps'))
	{
		window.onbeforeunload = function() {
			if($('.edit_field').is(':visible') && ($('.recipe_full .preparation_steps textarea').length > 1 || $('.recipe_full .ingredients ul li').length > 1))
			{
				return 'Det verkar som att du skriver in ett recept, om du lämnar sidan riskerar du att förlora osparad text. Är du säker på att du vill lämna sidan?';
			}
		}
	}

	$('.recipe_full .preparation_steps textarea').keyup(function() {
		console.log($(this).val());
		if($(this).val().length > 0)
		{
			if($(this).closest('li').next().length == 0)
			{
				console.log('appending');
				$(this).closest('li').clone(true).appendTo($(this).closest('ol'));
			}
		}
		else
		{
			if($(this).closest('li').next().find('textarea').val().length == 0)
			{
				$(this).closest('li').next().remove();
			}
		}
	});
	
	$('.recipe_full .ingredients input[type="text"]').keyup(function() {
		if($(this).val().length > 0)
		{
			if($(this).closest('li').next().length == 0)
			{
				var theclone = $(this).closest('li').clone(true);
				theclone.find('input').val('');
				theclone.appendTo($(this).closest('ul'));
			}
		}
	});
});


