$(document).ready(function() {
	$('#introduction_overlay button').click(function() {
		$('#introduction_overlay').animate({height: 0, opacity: 0}, 500, function() {
			$(this).remove();	
		});
	});


	if(!$.cookie('returning_visitor'))
	{
		$.cookie('returning_visitor', true, {expires: 1000, path: '/'});
		
		var timeout;

		timeout = setTimeout(function() {
			$('#introduction_overlay').fadeOut(2000);
		}, 6500);
		
		$('#introduction_overlay').mouseenter(function() {
			$('#introduction_overlay').stop(true);
			$('#introduction_overlay').animate({opacity: 1}, 0);
			clearTimeout(timeout);
		});
	
		$('#introduction_overlay').mouseenter(function() {
			timeout = setTimeout(function() {
				$('#introduction_overlay').fadeOut(2000);
			}, 6500);
		});
		
		setTimeout(function() {
			$('#introduction_overlay').slideDown(500);
		}, 1500);
	}

});
