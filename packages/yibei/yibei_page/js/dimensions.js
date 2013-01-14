$(window).resize(function() {
	var w = $(window).width();

	if(w < 640) {
		$('body').addClass('narrow');
		$('body').removeClass('wide');
	}
	if(w >= 640) {
		$('body').addClass('wide');
		$('body').removeClass('narrow');
	}

	var pad = 10;

	var col_w = Math.floor(($('.page').innerWidth() - pad*11)/12);

	console.log($('.page').innerWidth());
	console.log(col_w);

	$('.Columns4').css('width', col_w*4 + pad*3);
});

$('document').ready(function() {
	$(window).resize();
});


