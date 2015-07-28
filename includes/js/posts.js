( function( $ ) {
	"use strict";

	$.fn.wcShortcodesMasonryImagesReveal = function( $items ) {
		var msnry = this.data('masonry');

		$.each( $items, function( key, item ) {
			var $item = $(this);

			$item.imagesLoaded().always( function( instance ) {
				// un-hide item
				$item.show();

				// masonry does its thing
				msnry.layout();
			});
		});

		return this;
	};

	var calculateGrid = function($container) {
		var columns = parseInt( $container.data('columns') );
		var gutterWidth = $container.data('gutterSpace');
		// need to return exact decimal width
		var containerWidth = Math.floor($container[0].getBoundingClientRect().width);
		var minColumnWidth = 200;

		if ( isNaN( gutterWidth ) ) {
			gutterWidth = 20;
		}
		else if ( gutterWidth > 50 || gutterWidth < 0 ) {
			gutterWidth = 20;
		}

		gutterWidth = parseInt( gutterWidth );

		var allGutters = gutterWidth * ( columns - 1 );
		var contentWidth = containerWidth - allGutters;

		var columnWidth = Math.floor( contentWidth / columns );

		if ( columnWidth < minColumnWidth ) {
			columns = Math.floor( contentWidth / minColumnWidth );

			if ( columns < 1 ) {
				columns = 1;
			}

			allGutters = gutterWidth * ( columns - 1 );
			contentWidth = containerWidth - allGutters;

			columnWidth = Math.floor( contentWidth / columns );
		}

		return {columnWidth: columnWidth, gutterWidth: gutterWidth, columns: columns};
	}

	var runMasonry = function( duration, $container, $posts ) {
		var o = calculateGrid($container);

		$posts.css({'width':o.columnWidth+'px', 'margin-bottom':o.gutterWidth+'px', 'padding':'0'});

		$container = $container.masonry( {
			itemSelector: '.wc-shortcodes-post-box',
			columnWidth: o.columnWidth,
			gutter: o.gutterWidth,
			transitionDuration: duration 
		} );
	}

	$(document).ready(function(){
		$('.wc-shortcodes-posts').each( function() {
			var $container = $(this);
			var $posts = $container.children('.wc-shortcodes-post-box');

			$posts.hide();

			// keeps the media elements from calculating for the full width of the post
			runMasonry(0, $container, $posts);

			// we are going to append masonry items as the images load
			$container.wcShortcodesMasonryImagesReveal( $posts );

			$(window).resize(function() {
				runMasonry(0, $container, $posts);
			}); 

			$container.find(".wc-shortcodes-post-box .rslides").responsiveSlides({
				auto: false,             // Boolean: Animate automatically, true or false
				speed: 500,            // Integer: Speed of the transition, in milliseconds
				timeout: 4000,          // Integer: Time between slide transitions, in milliseconds
				pager: false,           // Boolean: Show pager, true or false
				nav: true,             // Boolean: Show navigation, true or false
				random: false,          // Boolean: Randomize the order of the slides, true or false
				pause: false,           // Boolean: Pause on hover, true or false
				pauseControls: true,    // Boolean: Pause when hovering controls, true or false
				prevText: "",   // String: Text for the "previous" button
				nextText: "",       // String: Text for the "next" button
				maxwidth: "",           // Integer: Max-width of the slideshow, in pixels
				navContainer: "",       // Selector: Where controls should be appended to, default is after the 'ul'
				manualControls: "",     // Selector: Declare custom pager navigation
				namespace: "rslides",   // String: Change the default namespace used
				before: function(){},   // Function: Before callback
				after: function(){
					runMasonry(0, $container, $posts);
				}// Function: After callback
			});
		});

		var $filterNav = $('.wc-shortcodes-filtering.wc-shortcodes-filtering-dynamic.wc-shortcodes-filtering-layout-masonry');
		var $term = $filterNav.find('.wc-shortcodes-term');
		$term.click( function( event ) {
			event.preventDefault();

			$term.removeClass('wc-shortcodes-term-active');
			$(this).addClass('wc-shortcodes-term-active');

			var selector = $(this).attr('data-filter');
			var target = $filterNav.data('target');
			var $target = $(target);
			$target.animate({opacity: 0}, 300, function() {
				var $targetPosts = $target.children('.wc-shortcodes-post-box');
				if ( '*' == selector ) {
					$targetPosts.show();
				}
				else {
					$targetPosts.hide();
					$target.find(selector).show();
				}

				runMasonry(0, $target, $targetPosts);

				$target.animate({opacity: 1}, 300);
			});

			return false;
		});

	});
} )( jQuery );
