( function( $ ) {
	"use strict";

	$(document).ready(function(){
		$('.wc-shortcodes-tabs').each( function() {
			var $tabs = $(this);
			var $trigger = $tabs.find('.wcs-tabs-nav li a');
			var $content = $tabs.find('.tab-content');

			$content.first().show();
			$trigger.first().parent().addClass('wcs-state-active');

			$trigger.click(function( event ){
				event.preventDefault();

				var $this = $(this);
				var index = parseInt( $this.data('index') );
				var $target = $content.eq(index);

				$trigger.parent().removeClass('wcs-state-active');
				$this.parent().addClass('wcs-state-active');

				$target.show();
				$content.not($target).hide();

				$( document.body ).trigger( 'wcs-toggled' );
				
				return false;
			});
		});
	});
} )( jQuery );
