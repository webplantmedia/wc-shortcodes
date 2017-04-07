( function( $ ) {
	"use strict";

	var body = $( 'body' ),
		_window = $( window );
	
	var calculateGrid = function($container) {
		var windowWidth = _window.width();
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

		if ( windowWidth <= 568 ) {
			columns = 1;

			allGutters = gutterWidth * ( columns - 1 );
			contentWidth = containerWidth - allGutters;

			columnWidth = Math.floor( contentWidth / columns );
		}

		return {columnWidth: columnWidth, gutterWidth: gutterWidth, columns: columns};
	}

	var runMasonry = function( duration, $container, $posts, method) {
		var o = calculateGrid($container);

		if ( o.columns == 1 ) {
			if ( $container.hasClass('masonry') ) {
				$container.masonry('destroy');
			}

			$container.removeAttr("style");
			$container.children().removeAttr("style");
			$container.css('height', 'auto');

			return;
		}
		else if ( 'layout' == method ) {
			$container.masonry('layout');

			return;
		}
		else {
			var marginBottom = o.gutterWidth;

			$posts.css({'width':o.columnWidth+'px', 'margin-bottom':o.gutterWidth+'px', 'padding':'0'});

			$container.masonry( {
				itemSelector: '.wc-shortcodes-post-box',
				columnWidth: o.columnWidth,
				gutter: o.gutterWidth,
				transitionDuration: duration 
			} );

			return;
		}
	}

	$('.wc-shortcodes-posts').each( function() {
		var $container = $(this);
		var $posts = $container.children('.wc-shortcodes-post-box');

		$posts.css({'visibility':'hidden','position':'relative'}).addClass('wc-shortcodes-loading');

		$.each( $posts, function( index, value ) {
			var $post = $(this);
			var $imgs = $post.find('img');

			if ( $imgs.length ) {
				$post.imagesLoaded()
					.always( function( instance ) {
						$post.css('visibility', 'visible').removeClass('wc-shortcodes-loading');
						runMasonry(0, $container, $posts, 'layout');
					});
			}
			else {
				$post.css('visibility', 'visible').removeClass('wc-shortcodes-loading');
			}
		});

		runMasonry(0, $container, $posts, 'masonry');

		$(window).resize(function() {
			runMasonry(0, $container, $posts, 'masonry');
		}); 

		// $(window).load(function() {
		// }); 

		if (window.twttr !== undefined) {
			twttr.ready(function (twttr) {
				twttr.events.bind('loaded', function (event) {
					//DO A MASONRY RELAYOUT HERE
					runMasonry(0, $container, $posts, 'layout');
				});
			});
		}

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
				runMasonry(0, $container, $posts, 'layout');
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

			runMasonry(0, $target, $targetPosts, 'layout');

			$target.animate({opacity: 1}, 300);
		});

		return false;
	});

} )( jQuery );
