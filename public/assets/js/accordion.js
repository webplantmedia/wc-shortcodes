( function( $ ) {
	"use strict";

	function get_height( $el ) {
		var height;
		height = $el.outerHeight();

		if ( height > 0 ) {
			height += "px";
			return height;
		}

		return 0;
	}
	function is_hidden( $el ) {
		var height = $el.outerHeight();
		if ( 0 == height )
			return true;

		return false;
	}

	$(document).ready(function(){
		$('.wc-shortcodes-accordion').each( function() {
			var $accordion = $(this);
			var $trigger = $accordion.find('.wc-shortcodes-accordion-trigger');
			var $content = $accordion.find('.wc-shortcodes-accordion-content-wrapper');

			var startState = $accordion.data('startState');
			var behavior = $accordion.data('behavior');

			if ( 'collapse' == startState ) {
				// nothing, leave hidden
			}
			else {
				$trigger.first().addClass('wc-shortcodes-accordion-header-active');
				$content.first().css('height','auto');
			}

			$trigger.click(function( event ){
				event.preventDefault();

				var $this = $(this);
				var $next = $this.next();
				var height = 0;

				if ( 'autoclose' == behavior ) {
					$trigger.removeClass('wc-shortcodes-accordion-header-active');

					if ( is_hidden( $next ) ) {
						$this.addClass('wc-shortcodes-accordion-header-active');
						height = get_height( $next.children() );
						$next.animate({height:height},'fast','linear',function() {$(this).css('height','auto')});
						$content.not($next).animate({height:0},'fast','linear');
					}
					else {
						$next.animate({height:0},'fast','linear');
					}

				}
				else {
					if ( is_hidden( $next ) ) {
						$this.addClass('wc-shortcodes-accordion-header-active');
						height = get_height( $next.children() );
						$next.animate({height:height},'fast','linear',function() {$(this).css('height','auto')});
					}
					else {
						$this.removeClass('wc-shortcodes-accordion-header-active');
						$next.animate({height:0},'fast','linear');
					}
				}

				return false;
			});
		});
	});
} )( jQuery );
