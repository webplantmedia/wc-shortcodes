( function( $ ) {
	"use strict";

	$.fn.extend({
        // change 'pluginname' to your plugin name (duh)
        wcColorPickerWidget: function(options) {
			var method = '';

			if ( 'string' == typeof options ) {
				method = options;
			}

			// options for the plugin
			var defaults = {
				colorPickerSelector: '.wc-shortcodes-widget-color-picker',
				modalSelector: '#wc-shortcode-modal'
			}
			options =  $.extend(defaults, options);


			var $modal = $( options.modalSelector );

			if ( $modal.length ) {
				$modal.on('wcShortcodesBeforeModalHide', function() {
					var $this = $(this);
					var $colorPicker = $this.find( options.colorPickerSelector );

					$colorPicker.each( function( index, el ) { 
						var $el = $(el);
						$el.wpColorPicker('close');
					});
				});
			}

			return this.each(function() {
				var $this = $(this);
				var $colorPicker = $this.find( options.colorPickerSelector );

				if ( $colorPicker.length ) {
					$colorPicker.each( function( index, el ) { 
						var $el = $(el);
						$el.wpColorPicker();
					});
				}
			});
		}
	});

} )( jQuery );
