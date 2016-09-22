( function( $ ) {
	"use strict";

	$(document).ready(function(){
		$('.wc-shortcodes-post-slider').bxSlider({
			'pager' : false,
			'mode' : 'fade',
			'nextText' : "<i class='fa fa-angle-right'></i>",
			'prevText' : "<i class='fa fa-angle-left'></i>",
			'onSliderLoad' : function() {
				$(this).parent().parent().parent('.wc-shortcodes-post-slider-wrapper').css('height', 'auto');
			}
		});
	});
} )( jQuery );
