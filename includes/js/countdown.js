( function( $ ) {
	"use strict";

	$(document).ready(function() {

		$('.wc-shortcodes-countdown').each( function() {
			var $this, date, until, message, format;

			$this = $(this);
			date = $this.data('date');
			message = $this.data('message');
			format = $this.data('format');
			date = new Date( date ); 

			$this.countdown({
				until: date,
				format: format,
				alwaysExpire: true,
				onExpiry: function() {
					var $this = $(this);
					$this.html("<span class='countdown_expired_message'>"+message+"</span>");
				}
			});
		});

	});
} )( jQuery );
