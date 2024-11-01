jQuery(function ($) {

if ( pagenow == 'edit-wpsclp_locker' ) {
		
	$('.add-new-h2').addClass('button');
		
	
	$('#wpbody .wrap').wrapInner('<div id="wpsclp-col-left" />');
	$('#wpbody .wrap').wrapInner('<div id="wpsclp-cols" />');
	$('#wpsclp-col-right').removeClass('hidden').prependTo('#wpsclp-cols');
			
	$('#wpsclp-col-left > .icon32').insertBefore('#wpsclp-cols');
	$('#wpsclp-col-left > h2').insertBefore('#wpsclp-cols');
	   
    $('td.column-date').each(function(index, elem){

        var abbr = $(this).find('abbr').text();
       
        $(this).html(abbr);

    });

}

if ( pagenow == 'wpsclp_locker' ) {
	$('.add-new-h2').hide();
    
    $('#mask_colorpicker').hide();
    $('#mask_colorpicker').farbtastic('#mask_color_field');

    $('#mask_color_field').click(function() {
        $('#mask_colorpicker').fadeIn();
    });

    $('#border_colorpicker').hide();
    $('#border_colorpicker').farbtastic('#border_color_field');

    $('#border_color_field').click(function() {
        $('#border_colorpicker').fadeIn();
    });

    $(document).mousedown(function() {
            $('#mask_colorpicker').each(function() {
                var display = $(this).css('display');
                if ( display == 'block' )
                    $(this).fadeOut();
            });
            $('#border_colorpicker').each(function() {
                var display = $(this).css('display');
                if ( display == 'block' )
                    $(this).fadeOut();
            });
    });

}

$('#ibtn-enable').iButton({
    labelOn: "Yes",
    labelOff: "No"
});

$('#shortcode_text_input').click(function() {
	$(this).select();
});




//end
});