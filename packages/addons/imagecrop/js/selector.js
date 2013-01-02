function imagecrop_selector(callback, options){
	var imageinfo = {}
	
	var div = $('<div />');
	div.addClass('imagecrop_selector');
	$('<span>X</span>').addClass('close').click(function() { $(this).parent().remove(); }).appendTo(div);

	var cropper = $('<div/>').addClass('cropper');
	var img = $('<img />').addClass('image');
	img.appendTo(cropper);

	var selectorOptions = { instance: true, zIndex : 5, zindex: 5, onSelectChange: function(img, selection){
		console.log(imageinfo.handle + ': ' + imageinfo.orig_w + ', ' + img.width + ', ' + imageinfo.orig_h + ', ' + img.height);
		console.log(imageinfo);	
		
		var scalex = imageinfo.orig_w / img.width;
		var scaley = imageinfo.orig_h / img.height;
		
		imageinfo.x1 = Math.round(selection.x1 * scalex);
		imageinfo.x2 = Math.round(selection.x2 * scalex);
		imageinfo.y1 = Math.round(selection.y1 * scaley);
		imageinfo.y2 = Math.round(selection.y2 * scaley);
	}};

	if(options.aspectRatio) {
		selectorOptions.aspectRatio = options.aspectRatio;
	}

	var areaSelector = img.imgAreaSelect(selectorOptions);

	var commit = $('<button>Save</button>');
	commit.click(function() {
		console.log('Saving crop: ');
		console.log(imageinfo);
		callback(imageinfo);
		$(this).parent().parent().remove();
		areaSelector.cancelSelection();

	});

	cropper.appendTo(div);	

	var controls = $('<div class="controls" />');
	commit.appendTo(controls);

	var upload = $('<form method="post" action="/imagecrop/upload" enctype="multipart/form-data" target="_blank" />');
	$('<input type="file" name="image" />').appendTo(upload);
	var submit = $('<input type="submit" value="Upload" />');

	submit.appendTo(upload);
	upload.appendTo(controls);

	controls.appendTo(div);




	var thumbs = $('<div />').addClass('thumbs');

	$.getJSON('/imagecrop/all_images.json', function(data) {
		$.each(data, function(key, val) {

			var img = $('<div />');
			$('<input type="hidden" value="' + key + '" />').appendTo(img);
			$('<img />').attr('src', '/imagecrop/' + key + '/85x85.png').appendTo(img);
			img.data('width', val.width);
			img.data('height', val.height);


			img.click(function () {
				var handle = $(this).find('input').val();
				imageinfo.handle = handle;
				imageinfo.orig_w = $(this).data('width');
				imageinfo.orig_h = $(this).data('height');
				
				$('.imagecrop_selector .cropper .image').attr('src', '/imagecrop/' + handle + '/500x500.png');
			});

			img.appendTo(thumbs);
		});
		$('<br style="clear: both;" />').appendTo(thumbs);
	});

	thumbs.appendTo(div);

	div.appendTo($('body'));
}
