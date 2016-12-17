jQuery(function($){
	"use strict";

	$(document).ready(function(){
		$('.wc-shortcodes-skillbar').each(function(){
			$(this).find('.wc-shortcodes-skillbar-bar').animate({ width: $(this).attr('data-percent') }, 1500 );
		});
	});
});
