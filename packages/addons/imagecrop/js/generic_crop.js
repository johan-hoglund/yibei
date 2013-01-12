$(document).ready(function() {
	$('.imagecrop_control').click(function() {
		var i_handle = $(this).siblings('input.handle');
		var i_x1 = $(this).siblings('input.x1');
		var i_x2 = $(this).siblings('input.x2');
		var i_y1 = $(this).siblings('input.y1');
		var i_y2 = $(this).siblings('input.y2');
		var i_w = $(this).siblings('input.w');
		var i_h = $(this).siblings('input.h');
		var i_aspect = $(this).siblings('input.aspect_ratio').val();
		var preview = $(this).siblings('img.preview');
		
		options = {
			aspectRatio : i_aspect
		};

		imagecrop_selector(function(imageinfo) {
			if(imageinfo.handle) {
				i_handle.val(imageinfo.handle);
			}
			if(imageinfo.x1) {
				i_x1.val(imageinfo.x1);
			}
			if(imageinfo.x2) {
				i_x2.val(imageinfo.x2);
			}
			if(imageinfo.y1) {
				i_y1.val(imageinfo.y1);
			}
			if(imageinfo.y2) {
				i_y2.val(imageinfo.y2);
			}
			if(imageinfo.w) {
				i_w.val(imageinfo.w);
			}
			if(imageinfo.h) {
				i_h.val(imageinfo.h);
			}
		
			var aspect = (imageinfo.y2 - imageinfo.y1) / (imageinfo.x2 - imageinfo.x1);

			var imgurl = '/imagecrop/' + imageinfo.handle + '/' + imageinfo.x1 + '+' + imageinfo.x2 + '_' + imageinfo.y1 + '+' + imageinfo.y2 + '/' + preview.width() + 'x200.png';
			preview.attr('src', imgurl);
		}, options);
		return false;
	});
});




