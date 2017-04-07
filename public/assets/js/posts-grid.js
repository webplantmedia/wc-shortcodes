( function( $ ) {
	"use strict";

	$('.wc-shortcodes-posts.wc-shortcodes-posts-layout-grid').each( function() {
		var $container = $(this);
		var $posts = $container.children('.wc-shortcodes-post-box');

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
			after: function(){}// Function: After callback
		});
	});

	var $filterNav = $('.wc-shortcodes-filtering.wc-shortcodes-filtering-dynamic.wc-shortcodes-filtering-layout-grid');
	var $term = $filterNav.find('.wc-shortcodes-term');
	$term.click( function( event ) {
		event.preventDefault();

		$term.removeClass('wc-shortcodes-term-active');
		$(this).addClass('wc-shortcodes-term-active');

		var selector = $(this).attr('data-filter');
		var target = $filterNav.data('target');
		var $target = $(target);
		var $targetPosts = $target.children('.wc-shortcodes-post-box');
		$target.animate({opacity: 0}, 300, function() {
			if ( '*' == selector ) {
				$targetPosts.show();
			}
			else {
				$targetPosts.hide();
				$target.find(selector).show();
			}

			$target.animate({opacity: 1}, 300);
		});

		return false;
	});

} )( jQuery );
