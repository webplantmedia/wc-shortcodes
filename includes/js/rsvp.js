( function( $ ) {
	"use strict";

	$(document).ready(function() {

		$('.wc-shortcodes-rsvp').each( function() {
			var $this;

			$this = $(this);

			$this.find('.rsvp-button').click( function() {
				var $button = $(this);
				var data =  $this.find('.rsvp-data').serialize();
				var $message = $this.find('.rsvp-message');
				var $messageParent = $message.parent();
				$message.text("Sending...");
				$messageParent.removeClass('wc-shortcodes-box-warning wc-shortcodes-box-success').addClass('wc-shortcodes-box-info').show();

				$.post(
					WCShortcodes.ajaxurl,
					data,
					function( response ) {
						if (response.success) {
							$message.text(response.message);
							$messageParent.removeClass('wc-shortcodes-box-warning wc-shortcodes-box-info').addClass('wc-shortcodes-box-success').show();
							$button.hide();
						}
						else {
							$message.text(response.message);
							$messageParent.removeClass('wc-shortcodes-box-success wc-shortcodes-box-info').addClass('wc-shortcodes-box-warning').show();
						}
					}
				);
			});
		});

	});
} )( jQuery );
