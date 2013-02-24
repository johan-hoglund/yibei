$(document).ready(function() {
	$('.recipe_list li:has(a)').click(function() {
		window.location = $(this).find('a').attr('href');
	});
});

$(window).on('newdimensions', function() {
	$('.recipe_list.standard:not(.fixed) li').removeClass('col_4');
	$('.recipe_list.standard:not(.fixed) li').removeClass('col_3');
	$('.recipe_list.standard:not(.fixed) li').removeClass('col_2');
	switch(layout_mode)
	{
		case 'narrow':
			$('.recipe_list.standard:not(.fixed) li').addClass('col_4');
			$('.recipe_list.standard img').height(((col_4-2)/16)*9);
			break;
		case 'normal':
			$('.recipe_list.standard:not(.fixed) li').addClass('col_3');
			$('.recipe_list.standard img').height(((col_3-2)/16)*9);
			break;
		default:
			$('.recipe_list.standard:not(.fixed) li').addClass('col_2');	
			$('.recipe_list.standard img').height(((col_2-2)/16)*9);
	}


});




