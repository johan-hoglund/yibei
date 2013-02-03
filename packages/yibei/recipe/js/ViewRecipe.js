$(window).on('newdimensions', function() {
	$('.recipe_full header .image').removeClass('col_6 col_9 col_12');	
	$('.recipe_full .description').removeClass('col_3 col_9 col_12');	



	if(layout_mode == 'wide')
	{
		$('.user_profile_small').show(250);
		
		$('.recipe_full header .image').addClass('col_6');
		$('.recipe_full .description').addClass('col_3');
	}
	else if(layout_mode == 'normal')
	{
		$('.user_profile_small').show(250);
		
		$('.recipe_full header .image').addClass('col_9');
		$('.recipe_full .description').addClass('col_9');
	}
	else
	{
		$('.user_profile_small').hide(250);
		$('.recipe_full header .image').addClass('col_12');
		$('.recipe_full .description').addClass('col_12');
	}
});
