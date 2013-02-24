var layout_col = 0;
var layout_pad = 0;
var layout_marg = 0;
var layout_mode = 'normal';
var layout_submode = '';
var col_1, col_2, col_3, col_4, col_5, col_6, col_7, col_8, col_9, col_10, col_11, col_12 = 0;

$(window).resize(function() {
	var w = $(window).width();
	
	// NOTE: This requires native Float64Array() on client, we should revert to a lookup-table if it doesn't exist
	try
	{
		var problem = 'Maximize \n'
					+ 'obj: +12 x + 13 y \n'
					+ 'Subject To \n'
					+ 'colwidth: x -2y >= 0 \n'
					+ 'colwidth2: 4y - x >= 0 \n'
					+ 'equality: 2z + 12x + 13y = ' + w + ' \n'
					+ 'Bounds \n'
					+ 'x >= 0 \n'
					+ 'y >= 0 \n'
					+ 'z >= 0 \n'
					+ 'General \n'
					+ 'x y z \n'
					+ 'End';

		var lp = glp_create_prob();
		glp_read_lp_from_string(lp, null, problem);

		glp_scale_prob(lp, GLP_SF_AUTO);

		var smcp = new SMCP({presolve: GLP_ON});
		glp_simplex(lp, smcp);

		var iocp = new IOCP({presolve: GLP_ON});
		glp_intopt(lp, iocp);

		for(var i = 1; i <= glp_get_num_cols(lp); i++){
			switch(glp_get_col_name(lp, i))
			{
				case 'x':
					layout_col = glp_mip_col_val(lp, i);
					break;
				case 'y':
					layout_pad = glp_mip_col_val(lp, i);
					break;
				case 'z':
					layout_marg = glp_mip_col_val(lp, i);
					break;
			}
		}
	} 
	catch(err)
	{
		console.log(err);
		layout_pad = 20;
		layout_col = 60;
		layout_marg = 0;
	}

/*
	console.log(w);
	console.log('col: ' + layout_col);
	console.log('pad: ' + layout_pad);
	console.log('marg: ' + layout_marg);
*/

	col_1  = 1 * layout_col + 0 * layout_pad;
	col_2  = 2 * layout_col + 1 * layout_pad;
	col_3  = 3 * layout_col + 2 * layout_pad;
	col_4  = 4 * layout_col + 3 * layout_pad;
	col_5  = 5 * layout_col + 4 * layout_pad;
	col_6  = 6 * layout_col + 5 * layout_pad;
	col_7  = 7 * layout_col + 6 * layout_pad;
	col_8  = 8 * layout_col + 7 * layout_pad;
	col_9  = 9 * layout_col + 8 * layout_pad;
	col_10 = 10* layout_col + 9 * layout_pad;
	col_11 = 11* layout_col + 10 * layout_pad;
	col_12 = 12* layout_col + 11 * layout_pad;

	$('.col_1').width(col_1);
	$('.col_2').width(col_2);
	$('.col_3').width(col_3);
	$('.col_4').width(col_4);
	$('.col_5').width(col_5);
	$('.col_6').width(col_6);
	$('.col_7').width(col_7);
	$('.col_8').width(col_8);
	$('.col_9').width(col_9);
	$('.col_10').width(col_10);
	$('.col_11').width(col_11);
	$('.col_12').width(col_12);

	$('.col_1_wrapper').width(col_1 + layout_pad);
	$('.col_2_wrapper').width(col_2 + layout_pad);
	$('.col_3_wrapper').width(col_3 + layout_pad);
	$('.col_4_wrapper').width(col_4 + layout_pad);
	$('.col_5_wrapper').width(col_5 + layout_pad);
	$('.col_6_wrapper').width(col_6 + layout_pad);
	$('.col_7_wrapper').width(col_7 + layout_pad);
	$('.col_8_wrapper').width(col_8 + layout_pad);
	$('.col_9_wrapper').width(col_9 + layout_pad);
	$('.col_10_wrapper').width(col_10 + layout_pad);
	$('.col_11_wrapper').width(col_11 + layout_pad);
	$('.col_12_wrapper').width(col_12 + layout_pad);

	$('.vmarg').css('margin-top', layout_pad);
	layout_pad = (layout_pad-1)/2;
	
	for(var i = 1; i <= 12; i++)
	{
		$('.col_' + i).css('margin-left', layout_pad);
		$('.col_' + i).css('margin-right', layout_pad);
	}


	$('body').css('margin-left', layout_marg);
	$('body').css('margin-right', layout_marg);

	if(w > 1300)
	{
		layout_mode = 'wide';
	}
	else if(w > 640)
	{
		layout_mode = 'normal';
	}
	else
	{
		layout_mode = 'narrow';
	}

	$('body').removeClass('wide normal narrow');
	$('body').addClass(layout_mode);


	//console.log(w + ': ' + layout_mode);

	$(window).trigger('newdimensions');

});

$('document').ready(function() {
	// For some reason, this needs to be done twice
	$(window).trigger('resize');
	$(window).trigger('resize');
});


