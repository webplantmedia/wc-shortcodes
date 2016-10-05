( function( $ ) {
	"use strict";

	$.fn.extend({
        // change 'pluginname' to your plugin name (duh)
        wcPostSliderWidget: function(options) {

			// options for the plugin
            var defaults = {
				postTypeSelector: '.wc-shortcodes-widget-post-type-selector',
				autoCompleteSelector: '.wc-shortcodes-widget-autocomplete-select'
            }

			var options =  $.extend(defaults, options);

			var split = function ( val ) {
				return val.split( /,\s*/ );
			}
			var extractLast = function( term ) {
				return split( term ).pop();
			}

			return this.each(function() {
				var $this = $(this);
				var $autoComplete = $this.find( options.autoCompleteSelector );
				if ( $autoComplete.length ) {
					$autoComplete.each( function( index, el ) { 
						var $el = $(el);
						var type = $el.data('autocompleteType');
						var lookup = $el.data('autocompleteLookup');
						var $post_type = $this.find( options.postTypeSelector );
						var post_type = 'post';

						if ( 'multi' == type ) {
							$el.autocomplete({
								minLength: 0,
								source: function(request, response) {
									var term = extractLast( request.term );
									if ( $post_type.length ) {
										post_type = $post_type.val();
									}
									$.ajax({
										type: 'POST',
										dataType: 'json',
										url: ajaxurl,
										data: 'action=wc_' + lookup + '_lookup&request=' + term + '&post_type=' + post_type,
										success: function(data) {
											//response(data);
											response( $.ui.autocomplete.filter( data, term ) );
										}
									});
								},
								focus: function() {
									return false;
								},
								select: function( event, ui ) {
									var terms = split( this.value );
									// remove the current input
									terms.pop();
									// add the selected item
									terms.push( ui.item.value );
									// add placeholder to get the comma-and-space at the end
									terms.push( "" );

									this.value = terms.join( "," );

									return false;
								}
							}).bind('focus', function(){ $el.autocomplete("search"); } );;
						}
						else {
							$e.autocomplete({
								minLength: 1,
								source: function(request, response) {
									var term = request.term;
									$.ajax({
										type: 'POST',
										dataType: 'json',
										url: ajaxurl,
										data: 'action=wc_' + lookup + '_lookup&request=' + term,
										success: function(data) {
											response(data);
										}
									});
								}
							});
						}
					});
				}
			});
		}
	});
} )( jQuery );
