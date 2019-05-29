( function( $ ) {
	"use strict";

	$(document).ready(function(){
		var $panel5 = $('.wc-shortcodes-collage-slider-enabled .wc-shortcodes-collage-panel-5');

		$('.wc-shortcodes-collage-slider').each( function( index, el ) {
			var $this = $(this);
			var mode = $this.data('mode');
			var pause = $this.data('pause');
			var auto = $this.data('auto');
			var slider = $this.bxSlider({
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
					var $el = $(this);
					var $parent = $this.parent();
					$parent.css('height', '100%');
					$parent.parent().parent('.wc-shortcodes-collage-slider-wrapper').css('height', '100%');
					$panel5.removeClass('wc-shortcodes-loading');
				},
				'onSliderResize' : function() {
					$(this).parent().css('height','100%');
				}
			});
		});
		$('.wc-shortcodes-collage-has-link').each( function( index, el ) {
			var $this = $(this);
			var href = $this.data('href');
			$this.click( function() {
				window.location.href = href;
			});
		});
	});
} )( jQuery );
