( function( $ ) {
	"use strict";

	var $body = jQuery('body');

	var title = '<div class="media-frame-title"><h1></h1></div>';
	var innerContent = '<div class="media-frame-content"></div>';
	var insertButton = '<button type="button" class="button media-button button-primary button-large media-button-insert">Insert Shortcode</button>';
	var toolbar = '<div class="media-frame-toolbar"><div class="media-toolbar"><div class="media-toolbar-secondary"></div><div class="media-toolbar-primary search-form">'+insertButton+'</div></div></div>';

	var button = '<button type="button" class="button-link media-modal-close"><span class="media-modal-icon"><span class="screen-reader-text">Close media panel</span></span></button>';
	var content = '<div class="media-modal-content"><div class="media-frame mode-select wp-core-ui hide-router">'+title+innerContent+toolbar+'</div></div>';
	var backdrop = '<div class="media-modal-backdrop"></div>';

	$body.append('<div id="wc-shortcode-modal"><div class="media-modal wp-core-ui">'+button+content+'</div>'+backdrop+'</div>');

	var $modal = $body.find('#wc-shortcode-modal');
	var $title = $modal.find('.media-frame-title h1');
	var $innerContent = $modal.find('.media-frame-content');
	var $close = $modal.find('.media-modal-close');
	var $insertButton = $modal.find('.media-button-insert');
	var $insert = $modal.find('.media-button-insert');
	var $backdrop = $modal.find('.media-modal-backdrop');

	var close = function() {
		$modal.hide();
		$innerContent.html('');
	}
	var getNameValue = function() {
	}
	var insertShortcode = function() {
		var id = $(this).data('id');
		var data = $innerContent.serialize();
		var $fields = $innerContent.find("[name^='widget-wc_shortcodes_post_slider[]']");

		var values = {}
		$.each( $fields, function( i, el ) {
			var $el = $(el);
			var val = $el.val();
			var key = $el.attr('name').split('][').pop();
			key = key.substring( 0, key.length - 1 );
			values[key] = val;
		});
		console.log(values);

		/* $.post(ajaxurl, {action: 'wc_mce_get_shortcode', id: id}, function(result){
			alert(result);
		});  */
	}

	$close.on('click', close);
	$backdrop.on('click', close);
	$insertButton.on('click', insertShortcode);

	window.wcShortcodes = function(id,title,editor) {
		$title.text(title);
		$modal.show();
		$insertButton.data('id', id);

		$.post(ajaxurl, {action: 'wc_mce_popup', id: id}, function(result){
			$innerContent.html(result);

		}); 
		// editor.insertContent('[wc_post_slider author="" author_name="" p="" post__in="" order="DESC" orderby="name" post_status="publish" post_type="post" posts_per_page="10" taxonomy="" field="slug" terms="" meta_category="no" title="yes" content="yes" readmore="Continue Reading" button_class="button secondary-button" size="full" heading_type="h2" heading_size="30" mobile_heading_size="24" excerpt_length="30" desktop_height="600" laptop_height="500" mobile_height="350" template="slider2"][/wc_post_slider]');
	}

} )( jQuery );
