( function( $ ) {
	"use strict";

	$(document).ready(function() {

		$('.wc-shortcodes-countdown').each( function() {
			var $this, date, until, message, format, labels, labels1;

			$this = $(this);
			date = $this.data('date');
			message = $this.data('message');
			format = $this.data('format');
			labels = $this.data('labels');
			labels1 = $this.data('labels1');
			date = new Date( date ); 

			if ( labels ) {
				var labels = labels.split(',')
			}
			if ( labels1 ) {
				var labels1 = labels1.split(',')
			}

			$this.countdown({
				labels: labels,
				labels1: labels1,
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
