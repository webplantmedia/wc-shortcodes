jQuery(function($){
	"use strict";

	$(document).ready(function(){
		$(".wc-shortcodes-toggle-trigger").click(function(){
			$(this).toggleClass("active").next().slideToggle("fast");
			$( document.body ).trigger( 'wcs-toggled' );
			return false;
		});
	});
});
