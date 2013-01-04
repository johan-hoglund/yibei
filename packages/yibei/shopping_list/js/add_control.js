$(document).ready(function() {
	$('.shopping_list_add_item').click(function() {
		var count = parseInt($('#top_nav li.shopping_list .count').html());
		count++;
		$('#top_nav li.shopping_list .count').html(count);
		$('#top_nav li.shopping_list .count').fadeIn(125);

		$('#top_nav li.shopping_list .list_preview').fadeIn(125);
		$('<li>' + $(this).attr('data-title') + '</li>').hide().prependTo($('#top_nav li.shopping_list .list_preview ul')).slideDown(250);
	});
});
