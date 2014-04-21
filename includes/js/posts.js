( function( $ ) {
	"use strict";

	$(document).ready(function(){
		var $container = $('.wc-shortcodes-posts');
		var $postBox = $container.children('.wc-shortcodes-post-box');
		var columnWidth = 0;
		var gutterWidth = 0;

		var calculateGrid = function() {
			var columns = parseInt( $container.data('columns') );
			var gutterSpace = $container.data('gutterSpace');
			var containerWidth = $container.width();
			var marginBottom = 0;

			if ( isNaN( gutterSpace ) ) {
				gutterSpace = .020;
			}
			else if ( gutterSpace > 0.05 || gutterSpace < 0 ) {
				gutterSpace = .020;
			}

			if ( containerWidth < 568 ) { columns = 1; }
			else if ( containerWidth < 768 ) { columns -= 2; }
			else if ( containerWidth < 991 ) { 
				columns -= 1;
				if ( columns < 2 ) {
					columns = 2;
				}
			}

			if ( columns < 1 ) {
				columns = 1;
			}

			gutterWidth = Math.floor( containerWidth * gutterSpace );

			var allGutters = gutterWidth * ( columns - 1 );
			var contentWidth = containerWidth - allGutters;

			columnWidth = Math.floor( contentWidth / columns );

			marginBottom = gutterWidth;
			if ( 1 == columns ) {
				marginBottom = 20;
			}
			$postBox.css({'width':columnWidth+'px', 'marginBottom':marginBottom+'px', 'padding':'0'});
		}

		var runMasonry = function( duration ) {
			calculateGrid();

			$container.masonry( {
				itemSelector: '.wc-shortcodes-post-box',
				columnWidth: columnWidth,
				gutter: gutterWidth,
				transitionDuration: duration 
			} );
		}

		// keeps the media elements from calculating for the full width of the post
		runMasonry(0);

		imagesLoaded( $container, function() {
			runMasonry(0);

			$container.css('visibility', 'visible');
		});

		$(window).resize(function() {
			runMasonry(0);
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

				runMasonry(0);

				$target.animate({opacity: 1}, 300);
			});

			return false;
		});

		$(".wc-shortcodes-post-box .rslides").responsiveSlides({
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
				runMasonry(0);
			}// Function: After callback
		});
	});
} )( jQuery );
