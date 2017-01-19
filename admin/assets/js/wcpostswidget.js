( function( $ ) {
	"use strict";

	$.fn.extend({
        // change 'pluginname' to your plugin name (duh)
        wcPostsWidget: function(options) {
			// options for the plugin
            var defaults = {
				postTypeSelector: '.wc-shortcodes-widget-post-type-selector',
				taxonomySelector: '.wc-shortcodes-widget-taxonomy-selector',
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
				var $post_type = $this.find( options.postTypeSelector );
				var $taxonomy = $this.find( options.taxonomySelector );

				if ( $autoComplete.length ) {
					$autoComplete.each( function( index, el ) { 
						var $el = $(el);
						var $parent = $el.parent();
						$parent.css({'position':'relative'});
						var type = $el.data('autocompleteType');
						var lookup = $el.data('autocompleteLookup');
						var post_type = 'post';
						var taxonomy = '';
						var options = '';

						if ( 'multi' == type ) {
							options = {
								minLength: 0,
								appendTo: $parent,
								source: function(request, response) {
									var term = extractLast( request.term );
									if ( $post_type.length ) {
										post_type = $post_type.val();
									}
									if ( $taxonomy.length ) {
										taxonomy = $taxonomy.val();
									}
									$.ajax({
										type: 'POST',
										dataType: 'json',
										url: ajaxurl,
										data: 'action=wc_' + lookup + '_lookup&request=' + term + '&post_type=' + post_type + '&taxonomy=' + taxonomy,
										success: function(data) {
											response( data );
										}
									});
								},
								select: function( event, ui ) {
									var terms = split( this.value );
									// remove the current input
									terms.pop();
									// add the selected item
									terms.push( ui.item.value );
									// add placeholder to get the comma-and-space at the end
									terms.push( "" );

									$(this).val( terms.join( "," ) );

									return false;
								},
								focus: function( event, ui ) {
									return false; // Prevent comma delim value from being replace by single value.
								},
								close: function( event, ui ) {
									var $t = $(this);
									$t.trigger('change');
									// setTimeout(function(){
										// $t.blur();
									// }, 0);
								}
							}
						}
						else {
							options = {
								minLength: 0,
								appendTo: $parent,
								source: function(request, response) {
									var term = request.term;
									if ( $post_type.length ) {
										post_type = $post_type.val();
									}
									if ( $taxonomy.length ) {
										taxonomy = $taxonomy.val();
									}
									$.ajax({
										type: 'POST',
										dataType: 'json',
										url: ajaxurl,
										data: 'action=wc_' + lookup + '_lookup&request=' + term + '&post_type=' + post_type + '&taxonomy=' + taxonomy,
										success: function(data) {
											response(data);
										}
									});
								},
								close: function ( event, ui ) {
									var $t = $(this);
									$t.trigger('change');
									// setTimeout(function(){
										// $t.blur();
									// }, 0);
								}
							};
						}

						$el.autocomplete( options ).bind('focus', function(){ $(this).autocomplete("search"); } );
					});
				}
				if ( $taxonomy.length ) {
					$taxonomy.change( function() {
						var $th = $(this);
						var $option = $th.find(":selected");
						if ( $option.length ) {
							var post_type = $option.data('postType');
							if ( typeof post_type == "string" ) {
								$post_type.val(post_type);
							}
						}
					});
				}
			});
		}
	});
} )( jQuery );
