( function( $ ) {
	"use strict";

	$(document).ready(function(){
		$('.wc-shortcodes-tabs').each( function() {
			var $tabs = $(this);
			var $trigger = $tabs.find('.wcs-tabs-nav li a');
			var $content = $tabs.find('.tab-content-wrapper');

			$content.first().removeClass('tab-content-hide');
			$trigger.first().parent().addClass('wcs-state-active');

			$trigger.click(function( event ){
				event.preventDefault();

				var $this = $(this);
				var index = parseInt( $this.data('index') );
				var $target = $content.eq(index);

				$trigger.parent().removeClass('wcs-state-active');
				$this.parent().addClass('wcs-state-active');

				$target.removeClass('tab-content-hide');
				$content.not($target).addClass('tab-content-hide');

				return false;
			});
		});
	});
} )( jQuery );
