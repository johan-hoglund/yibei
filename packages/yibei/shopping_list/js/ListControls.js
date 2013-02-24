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

	$('.ShoppingList ul').sortable({connectWith: ".ShoppingList ul", stop: ShoppingListSortStop}).disableSelection();
});


function ShoppingListSortStop(event, ui) {
	var commodity_id = $(event.toElement).closest('li').attr('data-commodity_id');

	var group_id = $(event.toElement).closest('ul').attr('data-group_id');
	console.log('Sorting commodity ' + commodity_id + ' to group ' + group_id);

	$.get('/shopping_list/assignGroup.json?gid=' + group_id + '&cid=' + commodity_id);
}

