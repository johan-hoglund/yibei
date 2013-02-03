$(document).ready(function() {
	$('#top_nav .filters .minimize_control').click(function() {
		if($(this).hasClass('minimized'))
		{
			$(this).closest('.filters').siblings('.browser').slideDown();
			$(this).html('&mdash;');
			$(this).removeClass('minimized');
		}
		else
		{
			$(this).closest('.filters').siblings('.browser').slideUp();
			$(this).html('&equiv;');
			$(this).addClass('minimized');
		}
	});

	$('#top_nav nav li.cook a').click(function() {
		console.log('Click');
		$('.recipe_search_control').slideDown();
		$('.filters .minimize_control').html('&mdash;');
		$('.filters .minimize_control').removeClass('minimized');
		return false;
	});

	$('#top_nav nav input[type="search"]').keyup(function() {
		$('.main').load('/json_search?q=' + escape($(this).val()));
		console.log('woot');
	});

});


