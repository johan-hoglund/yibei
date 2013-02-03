$('document').ready(function() {
	$('.ShoppingList ul li input').change(function() {
		if($(this).attr('checked'))
		{
			$(this).closest('li').addClass('checked');
			$.get('/shopping_list/setStatus.json?cid=' + $(this).val() + '&status=bought');
		}
		else
		{
			$(this).closest('li').removeClass('checked');
			$.get('/shopping_list/setStatus.json?cid=' + $(this).val() + '&status=pending');
		}
	});
	$('.ShoppingList ul li .remove_control').click(function() {
			console.log('Removing');
			$(this).closest('li').addClass('removed');
			$.get('/shopping_list/setStatus.json?cid=' + $(this).val() + '&status=deleted');
	});
});
