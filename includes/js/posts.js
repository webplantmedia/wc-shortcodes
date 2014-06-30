( function( $ ) {
	"use strict";

	var calculateGrid = function($container) {
		var columns = parseInt( $container.data('columns') );
		var gutterWidth = $container.data('gutterSpace');
		var containerWidth = $container.width();

		if ( isNaN( gutterWidth ) ) {
			gutterWidth = 20;
		}
		else if ( gutterWidth > 50 || gutterWidth < 0 ) {
			gutterWidth = 20;
		}

		if ( containerWidth < 568 ) {
			columns = 1;
		}
		else if ( containerWidth < 768 ) { 
			columns -= 2;
			if ( columns < 2 ) {
				columns = 2;
			}
		}
		else if ( containerWidth < 991 ) { 
			columns -= 1;
			if ( columns < 2 ) {
				columns = 2;
			}
		}

		if ( columns < 1 ) {
			columns = 1;
		}

		gutterWidth = parseInt( gutterWidth );

		var allGutters = gutterWidth * ( columns - 1 );
		var contentWidth = containerWidth - allGutters;

		var columnWidth = Math.floor( contentWidth / columns );

		return {columnWidth: columnWidth, gutterWidth: gutterWidth, columns: columns};
	}

	var runMasonry = function( duration, $container) {
		var $postBox = $container.children('.wc-shortcodes-post-box');

		var o = calculateGrid($container);

		var marginBottom = o.gutterWidth;
		/* if ( 1 == o.columns ) {
			marginBottom = 20;
		} */

		$postBox.css({'width':o.columnWidth+'px', 'margin-bottom':marginBottom+'px', 'padding':'0'});

		$container.masonry( {
			itemSelector: '.wc-shortcodes-post-box',
			columnWidth: o.columnWidth,
			gutter: o.gutterWidth,
			transitionDuration: duration 
		} );
	}

	$(document).ready(function(){
		$('.wc-shortcodes-posts').each( function() {
			var $container = $(this);
			var $postBox = $container.children('.wc-shortcodes-post-box');


			// keeps the media elements from calculating for the full width of the post
			runMasonry(0, $container);

			imagesLoaded( $container, function() {
				runMasonry(0, $container);

				$container.css('visibility', 'visible');
			});

			$(window).resize(function() {
				runMasonry(0, $container);
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
					runMasonry(0, $container);
				}// Function: After callback
			});
		});

		var $filterNav = $('.wc-shortcodes-filtering');
		var $term = $filterNav.find('.wc-shortcodes-term');
		$term.click( function( event ) {
			event.preventDefault();

			$term.removeClass('wc-shortcodes-term-active');
			$(this).addClass('wc-shortcodes-term-active');

			var selector = $(this).attr('data-filter');
			var target = $filterNav.data('target');
			var $target = $(target);
			$target.animate({opacity: 0}, 300, function() {
				if ( '*' == selector ) {
					$target.find('.wc-shortcodes-post-box').show();
				}
				else {
					$target.find('.wc-shortcodes-post-box').hide();
					$target.find(selector).show();
				}

				runMasonry(0, $target);

				$target.animate({opacity: 1}, 300);
			});

			return false;
		});

	});
} )( jQuery );
