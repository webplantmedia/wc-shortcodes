( function( $ ) {
	"use strict";

	$(document).ready(function(){
		$('.wc-shortcodes-post-slider').each( function( index, el ) {
			var $this = $(this);
			var mode = $this.data('mode');
			var pause = $this.data('pause');
			var auto = $this.data('auto');
			$this.bxSlider({
				'pager' : false,
				'mode' : mode,
				'auto' : auto,
				'touchEnabled': false, // fixes problem with links not working in Google Chrome.
				'autoHover' : true,
				'autoStart' : auto,
				'pause' : pause,
				'nextText' : "<i class='fa fa-angle-right'></i>",
				'prevText' : "<i class='fa fa-angle-left'></i>",
				'onSliderLoad' : function() {
					$(this).parent().parent().parent('.wc-shortcodes-post-slider-wrapper').css('height', 'auto');
				}
			});
		});
	});
} )( jQuery );
