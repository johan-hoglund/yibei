$(document).ready(function() {
	$('.recipe_list li:has(a)').click(function() {
		window.location = $(this).find('a').attr('href');
	});
});
