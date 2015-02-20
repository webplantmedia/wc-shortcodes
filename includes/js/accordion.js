( function( $ ) {
	"use strict";

	$(document).ready(function(){
		$('.wc-shortcodes-accordion').each( function() {
			var $accordion = $(this);
			var $trigger = $accordion.find('.wc-shortcodes-accordion-trigger');
			var $content = $accordion.find('.wc-shortcodes-accordion-content');

			var startState = $accordion.data('startState');
			var behavior = $accordion.data('behavior');

			if ( 'collapse' == startState ) {
				// nothing, leave hidden
			}
			else {
				$content.first().show();
				$trigger.first().addClass('wc-shortcodes-accordion-header-active');
			}

			$trigger.click(function( event ){
				event.preventDefault();

				var $this = $(this);
				var $next = $this.next();

				if ( 'autoclose' == behavior ) {
					$trigger.removeClass('wc-shortcodes-accordion-header-active');
					if ( $next.is(":hidden") ) {
						$this.addClass('wc-shortcodes-accordion-header-active');
					}

					$next.slideToggle('fast');
					$content.not($next).slideUp('fast');
				}
				else {
					if ( $next.is(":hidden") ) {
						$this.addClass('wc-shortcodes-accordion-header-active');
						$next.slideToggle('fast');
					}
					else {
						$this.removeClass('wc-shortcodes-accordion-header-active');
						$next.slideUp('fast');
					}
				}

				$( document.body ).trigger( 'wcs-toggled' );

				return false;
			});
		});
	});
} )( jQuery );
