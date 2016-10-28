( function( $ ) {
	"use strict";

	var mceEditor, mceTag, mceShortcode;

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
		var data = $innerContent.serialize();
		var $fields = $innerContent.find("[name^='widget-wc_shortcodes_post_slider[]']");

		var values = new Array();
		$.each( $fields, function( i, el ) {
			var $el = $(el);
			var val;
			if ( $el.is(':checkbox') ) {
				if ( $el.is(':checked') ) {
					val = $el.val();
				}
				else {
					val = 0;
				}
			}
			else {
				val = $el.val();
			}
			var key = $el.attr('name').split('][').pop();
			key = key.substring( 0, key.length - 1 );
			values.push( key + '="' + val + '"' );
		});
		console.log(values);
		values = values.join(" ");

		var rgxp = new RegExp("^\\["+mceTag+"\\s+.+?\\]", "g");
		// console.log(rgxp);

		// var shortcode = "["+mceTag+" "+values+"][/"+mceTag+"]";
		var shortcode = mceShortcode.replace(rgxp,"["+mceTag+" "+values+"]");

		mceEditor.insertContent(shortcode);
		close();
	}

	var getTag = function( shortcode ) {
		var tag = '', last = '';

		var a = shortcode.split('][');
		if ( a.length > 1 ) {
			var aa = a[0].split(' ');

			if ( aa.length ) {
				tag = aa[0];
				tag = tag.substring(1);

				last = a[a.length-1];
				last = last.substring(1).slice(0, -1);

				if ( tag == last )
					return tag;
			}
		}

		return '';
	}

	$close.on('click', close);
	$backdrop.on('click', close);
	$insertButton.on('click', insertShortcode);

	window.wcShortcodes = function(shortcode,editor) {
		mceEditor = editor;
		mceTag = getTag( shortcode );
		mceShortcode = shortcode;
		var error = shortcode;
		var msg;
		$modal.addClass('hide-insert-button');

		if ( mceTag ) {
			$title.text("["+mceTag+"]");
			$modal.show();
			$.post(ajaxurl, {action: 'wc_mce_popup', tag: mceTag, shortcode: shortcode}, function(result){
				if ( result.length ) {
					$modal.removeClass('hide-insert-button');
					$innerContent.html(result);
				}
				else {
					msg = "<h3>Not One Our Shortcodes</h3>";
					msg += "<p><code>["+mceTag+"]</code> is not supports by our shortcode manager.</p>";
					$innerContent.html(msg);
				}
			}); 
		}
		else {
			$title.text("[edit_selection]");
			$modal.show();

			if ( error.length ) {
				msg = 'Shortcode Selection Not Editable';
				error = error.replace(/\n/g,"##newline##");
				error = error.replace(/\s/g,"<span class='wc-shortcodes-error-yellow'> </span>");
				error = error.replace(/##newline##/g,"<span class='wc-shortcodes-error-red'>\\n</span>");
				$innerContent.html("<h4>"+msg+"</h4><p><code style='padding-left:0;padding-right:0'>"+error+"</code></p>");
			}
			else {
				msg = 'No Selection Found';
				error = 'Please select and highlight a shortcode in your editor to edit.';
				$innerContent.html("<h4>"+msg+"</h4><p><code style='padding-left:0;padding-right:0'>"+error+"</code></p>");
			}
		}
	}

} )( jQuery );
