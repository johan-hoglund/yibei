$('document').ready(function() {
	$('.ShoppingList ul li input').change(function() {
		console.log($(this));
		if($(this).attr('checked'))
		{
			$(this).closest('li').addClass('checked');
			$.get('/shopping_list/setStatus.json?cid=' + $(this).val() + '&status=bought');
		}
		else
		{
			$(this).closest('li').removeClass('checked');
		}

		
	});

});
