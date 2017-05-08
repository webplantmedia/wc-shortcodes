jQuery(function($){
	"use strict";

	function get_height( $el ) {
		var height;
		height = $el.outerHeight();

		if ( height > 0 ) {
			height += "px";
			return height;
		}

		return 0;
	}
	function is_hidden( $el ) {
		var height = $el.outerHeight();
		if ( 0 == height )
			return true;

		return false;
	}

	$(document).ready(function(){
		$(".wc-shortcodes-toggle-trigger").click(function(){
			var $this = $(this);
			var $next = $this.next();
			var height = 0;

			$this.toggleClass('active');

			if ( is_hidden( $next ) ) {
				height = get_height( $next.children() );
				$next.animate({height:height},'fast','linear',function() {$(this).css('height','auto')});
			}
			else {
				$next.animate({height:0},'fast','linear');
			}

			return false;
		});
	});
});
